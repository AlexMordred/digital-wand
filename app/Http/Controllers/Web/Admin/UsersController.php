<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function store()
    {
        $this->validator(request()->all())->validate();

        $user = User::forceCreate([
            'role' => User::ROLE_USER,
            'name' => request('name'),
            'email' => request('email'),
            'password' => Hash::make(request('password')),
        ]);

        return $user;
    }

    public function validator($data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|max:255',
        ]);
    }
}
