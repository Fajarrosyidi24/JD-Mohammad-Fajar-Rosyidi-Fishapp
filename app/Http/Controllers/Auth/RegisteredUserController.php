<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Services\RegistrationService;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\RegisterRequest;
use Illuminate\Auth\Events\Registered;


class RegisteredUserController extends Controller
{
    protected RegistrationService $service;

    public function __construct(RegistrationService $service)
    {
        $this->service = $service;
    }

    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterRequest $request)
    {
        $validated = $request->validated();
        $user = $this->service->createUser($validated);
        Auth::login($user);
        $roleName = str_replace(' ', '-', strtolower($user->roles->first()->name ?? 'user'));
        return redirect()->route('home', ['role' => $roleName])
            ->with('success', 'Data berhasil diperbarui.');
    }
}
