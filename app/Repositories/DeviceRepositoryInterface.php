<?php


namespace App\Repositories;


interface DeviceRepositoryInterface {
    public function getDevicesByUserId($user_id);

    public function findByUserIdAndDeviceId($user_id, $device_id);

    public function store($data);

    public function update($id, $data);

    public function delete($id);
}
