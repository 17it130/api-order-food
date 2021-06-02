<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\PaymentService;
use Illuminate\Http\Request;
use PHPUnit\Exception;

class PaymentController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function getAll()
    {
        try {
            $result = [
                'status' => 1,
                'payments' => $this->paymentService->getAll()
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
                'payment' => $this->paymentService->show($id)
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
