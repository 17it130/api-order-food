<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserRepository implements UserRepositoryInterface
{

    public function getAll()
    {
        return User::where('id', '<>', Auth::user()->id)
            ->get();
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
        return User::where('id', $id)->update($data);
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
