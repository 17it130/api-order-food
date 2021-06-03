<?php

namespace App\Repositories;

use App\Models\Device;

class DeviceRepository implements DeviceRepositoryInterface {

    public function getDevicesByUserId($user_id)
    {
        return Device::where('user_id', $user_id)->get();
    }

    public function findByUserIdAndDeviceId($user_id, $device_id)
    {
        return Device::where('device_id', $device_id)
                    ->where('user_id', $user_id)
                    ->first();
    }

    public function update($id, $data)
    {
        return Device::where('id', $id)->update($data);
    }

    public function delete($id)
    {
        return Device::findOrFail($id)->delete();
    }

    public function store($data)
    {
        return Device::create($data);
    }
}
