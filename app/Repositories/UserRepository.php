<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository implements UserRepositoryInterface {

    public function getAll()
    {
        return User::all();
    }

    public function getUsersByRole($role)
    {
        return User::where('role', $role)->get();
    }

    public function show($id)
    {
        return User::findOrFail($id);
    }

    public function update($data, $id)
    {
        return User::where('id', $id)->update([$data]);
    }

    public function store($data)
    {
        return User::create($data);
    }

    public function delete($id)
    {
        return User::findOrFail($id)->delete();
    }
}
