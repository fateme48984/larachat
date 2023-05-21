<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserRepository
{
    public function getContacts() {
        return User::where('id', '!=', Auth::id())->get();
    }

    public function getUser($userId) {
        return User::findOrFail($userId);
    }

    public function getUsers($userId) {
        return User::whereNot('id',$userId);
    }
}
