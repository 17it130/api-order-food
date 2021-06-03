<?php


namespace App\Traits;

use App\Services\PushNotificationService;


trait PushNotificationTrait
{
    public function pushMessage(string $deviceToken, array $notification, array $data)
    {
        $pushNotificationService = new PushNotificationService();

        return $pushNotificationService->send($deviceToken, $notification, $data);
    }

    public function pushMessages(array $deviceTokens, array $notification, array $data)
    {
        $pushNotificationService = new PushNotificationService();

        return $pushNotificationService->sendMultiple($deviceTokens, $notification, $data);
    }
}
