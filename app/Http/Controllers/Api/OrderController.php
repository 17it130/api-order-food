<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\OrderService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Exception;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService) {
        $this->orderService = $orderService;
    }

    public function getAll() {
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

    public function show($id) {
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

    public function store(Request $request) {
        try {
            $data = [
                'order_date' => Carbon::now(),
                'totalPrice' => $request->input('totalPrice'),
                'customer_id' => Auth::user()->id,
                'payment_id' => '',
                'status' => 0
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

            $result = [
                'status' => 1,
                'message' => 'Order successfull'
            ];
        } catch (Exception $e) {
            $result = [
                'status' => 0,
                'message' => $e->getMessage()
            ];
        }

        return response()->json($result);
    }

    public function update(Request $request, $id) {
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

            $result = [
                'status' => 1,
                'message' => 'Update order successfull'
            ];
        } catch (Exception $e) {
            $result = [
                'status' => 0,
                'message' => $e->getMessage()
            ];
        }

        return response()->json($result);
    }

    public function removeItemInOrderDetail($id) {
        try {
            $this->orderService->removeItemInOrderDetail($id);
            $result = [
                'status' => 1,
                'message' => 'Remove item successfull'
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
