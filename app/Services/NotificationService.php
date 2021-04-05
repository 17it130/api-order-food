<?php

namespace App\Services;

use App\Repositories\NotificationRepository;

class NotificationService
{
    protected $notificationRepository;

    public function __construct(NotificationRepository $notificationRepository)
    {
        $this->notificationRepository = $notificationRepository;
    }

    public function getAll()
    {
        return $this->notificationRepository->getAll();
    }

    public function store($data)
    {
        return $this->notificationRepository->store($data);
    }

    public function show($id)
    {
        return $this->notificationRepository->show($id);
    }

    public function update($data, $id)
    {
        return $this->notificationRepository->update($data, $id);
    }

    public function getNotificationByUserId($user_id)
    {
        return $this->notificationRepository->getNotificationByUserId($user_id);
    }

    public function readAllNotification($user_id)
    {
        return $this->notificationRepository->readAllNotification($user_id);
    }
}
