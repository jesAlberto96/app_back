<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersRepository
{
    public function getAll() 
    {
        return new UserCollection(User::paginate(2));
    }

    public function getByORCID($orcid) 
    {
        return User::with('keywords')->where('orcid', $orcid)->first();
    }

    public function create($data)
    {
        return User::create($data);
    }

    public function deleteByORCID($orcid)
    {
        return User::where('orcid', $orcid)->delete();
    }
}