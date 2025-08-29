<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        $user = $request->user();
        if ($user->hasVerifiedEmail()) {
            $roleName = str_replace(' ', '-', strtolower($user->roles->first()->name));
            return redirect()->route('dashboard', ['role' => $roleName])
                ->with('verified', 1);
        }
        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        $roleName = str_replace(' ', '-', strtolower($user->roles->first()->name));
        return redirect()->route('dashboard', ['role' => $roleName])
            ->with('verified', 1);
    }
    
}
