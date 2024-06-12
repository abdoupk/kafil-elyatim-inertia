<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|Response
    {
        return $request->user()?->hasVerifiedEmail()
            ? redirect()->intended(route('dashboard', absolute: false))
            : inertia()->render('Auth/VerifyEmailPage', ['status' => session('status')]);
    }
}
