<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Services\MenuService;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        return Inertia::render('Dashboard');
    }
}
