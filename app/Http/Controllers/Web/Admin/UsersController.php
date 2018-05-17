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

        return request()->wantsJson()
            ? $user
            : redirect()->route('admin.users.index');
    }

    public function validator($data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|max:255',
        ]);
    }

    public function index()
    {
        $users = User::where('role', User::ROLE_USER)->paginate(10);

        return request()->wantsJson()
            ? $users
            : view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }
}
