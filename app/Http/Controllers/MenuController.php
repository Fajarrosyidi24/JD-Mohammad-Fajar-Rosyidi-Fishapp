<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MenuService;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
     protected $menuService;

    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    public function index()
    {
        $user = Auth::user();
        $roleName = $user->roles->pluck('name')->first();
        $roleName2 = str_replace(' ', '-', strtolower(Auth::user()->roles->first()->name));
        $menus = $this->menuService->getMenusByRole($roleName);
        return response()->json(['user' => $user, 'menus' => $menus,'roleName' => $roleName2]);
    }
}
