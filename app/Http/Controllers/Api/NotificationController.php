<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\NotificationService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function getNotificationByUserId()
    {
        try {
            $result = [
                'status' => 1,
                'notifications' => $this->notificationService->getNotificationByUserId(Auth::user()->id)
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
            $this->notificationService->update(['isRead' => 1], $id);
            $result = [
                'status' => 1,
                'notification' => $this->notificationService->show($id)
            ];
        } catch (Exception $e) {
            $result = [
                'status' => 0,
                'message' => $e->getMessage()
            ];
        }

        return response()->json($result);
    }

    public function readAllNotification()
    {
        try {
            $this->notificationService->readAllNotification(Auth::user()->id);
            $result = [
                'status' => 1,
                'notification' => 'Update notifications successfully'
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
