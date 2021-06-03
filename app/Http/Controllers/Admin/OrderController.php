<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\FoodService;
use App\Services\NotificationService;
use App\Services\UserService;
use App\Services\CategoryService;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Exception;

use App\Http\Requests\FoodRequest;
use App\Models\Food;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    protected $foodService;

    public function __construct(FoodService $foodService, UserService $userService, CategoryService $categoryService, OrderService $orderService, NotificationService $notificationService) {
        $this->foodService = $foodService;
        $this->userService = $userService;
        $this->categoryService = $categoryService;
        $this->orderService = $orderService;
        $this->notificationService = $notificationService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        if (Auth::user()->role == 'admin') {
            $orders = $this->orderService->getAll();
        } else {
            $orders = $this->orderService->getAllWithUser(Auth::user()->id);
        }

        return view('admin.pages.order.index', compact('orders'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $order = $this->orderService->show($id);

        return view('admin.pages.order.detail', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $order_old = $this->orderService->show($id);

        if ($request->has('status') && $request->input('status') == 2) {
            $notification_data = [
                'title' => 'Order has been successfully delivered!',
                'content' => 'Your order has been delivered successfully. Wish you delicious!',
                'user_id' => $order_old[0]->customer_id,
                'order_id' => $order_old[0]->id
            ];

            $this->notificationService->store($notification_data);

            $devices = $this->deviceService->getDevicesByUserId($order_old[0]->customer_id);

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
        }

        $data = [
            'order_date' => $order_old[0]->order_date,
            'totalPrice' => $order_old[0]->totalPrice,
            'customer_id' => $order_old[0]->customer_id,
            'payment_id' => $order_old[0]->payment_id,
            'status' => $request->input('status')
        ];

        $this->orderService->update($data, $id);

        return redirect()->back()->with('edit', true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->foodService->delete($id);

        return response()->json(true);
    }
}
