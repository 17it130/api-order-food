<?php

namespace App\Repositories;

use App\Models\Notification;

class NotificationRepository implements NotificationRepositoryInterface
{
    public function getAll()
    {
        return Notification::with('order')->all();
    }

    public function getNotificationByUserId($user_id)
    {
        return Notification::with('order')->where('user_id', $user_id)->get();
    }

    public function show($id)
    {
        return Notification::with('order')->findOrFail($id);
    }

    public function update($data, $id)
    {
        return Notification::where('id', $id)
            ->update($data);
    }

    public function readAllNotification($user_id)
    {
        return Notification::where('user_id', $user_id)
            ->where('isRead', 0)
            ->update(['isRead' => 1]);
    }

    public function store($data)
    {
        return Notification::create($data);
    }
}
