<?php

namespace App\Repositories\User;

use App\Models\Keyword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class KeywordsRepository
{
    public function create($data)
    {
        return Keyword::create($data);
    }
}