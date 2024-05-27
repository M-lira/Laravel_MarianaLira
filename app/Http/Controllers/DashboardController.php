<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    //admin
    public function index()
    {
        $isAdmin = Auth::user()->user_type == User::TYPE_ADMIN ? true : false;

        $message = null;
        if ($isAdmin) {
            $message = "";
        }

        return view('dashboard.dashboard', compact('message'));
    }

}
