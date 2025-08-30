<?php

namespace App\Http\Controllers\Admin\UserManagement;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserManagementController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $roles = Role::all();
        if ($user->roles->pluck('name')->contains('Super Admin')) {
            $dataRoles = $roles;
        } else {
            $dataRoles = $roles->whereNotIn('name', ['Super Admin', 'Admin']);
        }

        if ($user->roles->pluck('name')->contains('Super Admin')) {
            $users = User::with('roles')->get();
        } else {
            $users = User::with('roles')
                ->whereDoesntHave('roles', function ($query) {
                    $query->whereIn('name', ['Super Admin', 'Admin']);
                })
                ->get();
        }
        return Inertia::render('Menu/Usermanagement/index', [
            'user' => $users,
            'dataroles' => $dataRoles,
        ]);
    }

    public function show($role, $id)
    {
        $user = User::with('roles', 'detail')->where('id', $id)->first();
        return Inertia::render('Menu/Usermanagement/show', [
            'user' => $user
        ]);
    }
}
