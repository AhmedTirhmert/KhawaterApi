<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->user()->hasVerifiedEmail()) {
            return response()->json([
                'resend' => false,
                'response' => 'This user has already verified his email'
            ], 200);
            // return redirect()->intended(RouteServiceProvider::HOME);
        }

        $request->user()->sendEmailVerificationNotification();
        return response()->json([
            'resend' => true,
            'response' => 'an email has been sent to your Email Adresse'
        ], 200);
        // return back()->with('status', 'verification-link-sent');
    }
}
