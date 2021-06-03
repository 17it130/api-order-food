<?php


namespace App\Services;


use App\Repositories\DeviceRepository;

class DeviceService
{
    protected $deviceRepository;

    public function __construct(DeviceRepository $deviceRepository)
    {
        $this->deviceRepository = $deviceRepository;
    }

    public function getDevicesByUserId($user_id) {
        return $this->deviceRepository->getDevicesByUserId($user_id);
    }

    public function findByUserIdAndDeviceId($user_id, $device_id) {
        return $this->deviceRepository->findByUserIdAndDeviceId($user_id, $device_id);
    }

    public function update($id, $data) {
        return $this->deviceRepository->update($id, $data);
    }

    public function delete($id) {
        return $this->deviceRepository->delete($id);
    }

    public function store($data) {
        return $this->deviceRepository->store($data);
    }
}
