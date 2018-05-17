<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\User;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->role != User::ROLE_USER) {
            return redirect()->route('admin.index');
        }

        return view('user.index');
    }
}
