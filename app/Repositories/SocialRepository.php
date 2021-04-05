<?php


namespace App\Repositories;


use App\Models\SocialAccount;

class SocialRepository implements SocialRepositoryInterface
{

    public function store($data)
    {
        return SocialAccount::create($data);
    }

    public function getByUserId($id)
    {
        return SocialAccount::where('user_id', $id)->get();
    }

    public function show($id)
    {
        return SocialAccount::findOrFail($id);
    }

    public function getBySocialId($social_id)
    {
        return SocialAccount::with('user')
            ->where('social_id', $social_id)
            ->first();
    }
}
