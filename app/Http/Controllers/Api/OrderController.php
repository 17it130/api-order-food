<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\DeviceService;
use App\Services\NotificationService;
use App\Services\OrderService;
use App\Traits\PushNotificationTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use PHPUnit\Exception;

class OrderController extends Controller
{
    use PushNotificationTrait;

    protected $orderService;
    protected $notificationService;
    protected $deviceService;

    public function __construct(OrderService $orderService, NotificationService $notificationService, DeviceService $deviceService)
    {
        $this->orderService = $orderService;
        $this->notificationService = $notificationService;
        $this->deviceService = $deviceService;
    }

    public function getAll()
    {
        try {
            $result = [
                'status' => 1,
                'orders' => $this->orderService->getAll()
            ];
        } catch (Exception $e) {
            $result = [
                'status' => 0,
                'message' => $e->getMessage()
            ];
        }

        return response()->json($result);
    }

    public function show($id)
    {
        try {
            $result = [
                'status' => 1,
                'order' => $this->orderService->show($id)
            ];
        } catch (Exception $e) {
            $result = [
                'status' => 0,
                'message' => $e->getMessage()
            ];
        }

        return response()->json($result);
    }

    public function store(Request $request)
    {
        try {
            $data = [
                'order_date' => Carbon::now(),
                'totalPrice' => $request->input('totalPrice'),
                'customer_id' => Auth::user()->id,
                'payment_id' => $request->input('payment_id') ? $request->input('payment_id') : '',
                'status' => $request->input('payment_id') ? 0 : 1,
                'order_note' => $request->input('order_note'),
                'order_code' => Str::upper(Str::random(6))
            ];

            $order = $this->orderService->store($data);

            foreach ($request->input('foods') as $item) {
                $detail_data = [
                    'order_id' => $order->id,
                    'food_id' => $item['food_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'shop_id' => $item['shop_id']
                ];

                $this->orderService->storeOrderDetail($detail_data);
            }

            $notification_data = [
                'title' => 'Order Success!',
                'content' => 'You have successfully placed an order with the order number '.$data['order_code'],
                'user_id' => Auth::user()->id
            ];

            $this->notificationService->store($notification_data);

            $devices = $this->deviceService->getDevicesByUserId(Auth::user()->id);

            if (isset($devices)) {
                foreach ($devices as $device) {
                    $data = [
                        'func_name' => config('firebase.notification.func'),
                        'screen' => config('firebase.notification.screen'),
                        'device_type' => $device->device_type,
                    ];

                    $content = [
                        "title" => $notification_data['title'],
                        "body" => $notification_data['content'],
                        'sound' => config('firebase.sound')
                    ];

                    // Push notification
                    $this->pushMessage($device->push_token, $content, $data);
                }
            }

            $result = [
                'status' => 1,
                'message' => 'Order successfully'
            ];
        } catch (Exception $e) {
            $result = [
                'status' => 0,
                'message' => $e->getMessage()
            ];
        }

        return response()->json($result);
    }

    public function update(Request $request, $id)
    {
        try {
            $data = [
                'totalPrice' => $request->input('totalPrice'),
                'payment_id' => $request->input('payment_id') ? $request->input('payment_id') : '',
                'status' => $request->input('payment_id') ? 0 : 1
            ];

            $this->orderService->update($data, $id);

            foreach ($request->input('foods') as $item) {
                $detail_data = [
                    'food_id' => $item['food_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'shop_id' => $item['shop_id']
                ];

                $this->orderService->updateOrderDetail($detail_data, $id);
            }

            if ($request->input('payment_id')) {
                $notification_data = [
                    'title' => 'Thành toán thành công',
                    'content' => 'Bạn đã thanh toán thành công',
                    'user_id' => Auth::user()->id
                ];

                $this->notificationService->store($notification_data);
            }

            $result = [
                'status' => 1,
                'message' => 'Update order successfully'
            ];
        } catch (Exception $e) {
            $result = [
                'status' => 0,
                'message' => $e->getMessage()
            ];
        }

        return response()->json($result);
    }

    public function removeItemInOrderDetail($id)
    {
        try {
            $this->orderService->removeItemInOrderDetail($id);
            $result = [
                'status' => 1,
                'message' => 'Remove item successfully'
            ];
        } catch (Exception $e) {
            $result = [
                'status' => 0,
                'message' => $e->getMessage()
            ];
        }

        return response()->json($result);
    }
}
