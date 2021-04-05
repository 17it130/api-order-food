<?php

namespace App\Repositories;

interface NotificationRepositoryInterface
{
    public function getAll();

    public function getNotificationByUserId($user_id);

    public function show($id);

    public function update($data, $id);

    public function store($data);

    public function readAllNotification($user_id);
}
