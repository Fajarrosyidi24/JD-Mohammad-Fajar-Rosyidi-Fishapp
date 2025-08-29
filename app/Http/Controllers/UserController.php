<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\RegistrationService;
use App\Http\Requests\RegisterRequest;

class UserController extends Controller
{
    protected RegistrationService $service;

    public function __construct(RegistrationService $service)
    {
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     */
    public function index($token)
    {
        $user = User::where('remember_token', $token)->first();
        return Inertia::render('UserCreate', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RegisterRequest $request, $id)
    {
        $validated = $request->validated();
        $user = $this->service->updateUser($id, $validated);
        if (!$user) {
            return redirect()->back()->with('error', 'Data About setting tidak ditemukan.');
        }
        Auth::login($user);
        $roleName = str_replace(' ', '-', strtolower($user->roles->first()->name ?? 'user'));
        return redirect()->route('dashboard', ['role' => $roleName])
            ->with('success', 'Data berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
