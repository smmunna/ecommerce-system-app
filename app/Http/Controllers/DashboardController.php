<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    public function dashboard()
    {
        $totalRegisterUser = DB::table('users')->count();
        $totalReviews = DB::table('reviews')->count();
        return view(
            'pages.dashboard.dashboard',
            [
                'totalRegisterUser' => $totalRegisterUser,
                'totalReviews' => $totalReviews
            ]
        );
    }
}
