<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Tutorial;
use App\Models\Banner;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource counts on the dashboard.
     */
    public function dashboard()
    {
        $stats = [
            'categories' => Category::count(),
            'tutorials' => Tutorial::count(),
            'banners' => Banner::count(),
            'active_banners' => Banner::where('is_active', true)->count(),
            'users' => User::count(),
        ];

        return view('dashboard', compact('stats'));
    }
}
