<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\User;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->role != User::ROLE_ADMIN) {
            return redirect()->route('user.index');
        }

        return view('admin.index');
    }
}
