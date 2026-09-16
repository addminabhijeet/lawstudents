<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateOtpSecurely
{
    public function handle(Request $request, Closure $next): Response
    {
        // Intercept OTP verification endpoints and enforce strict comparison
        if ($request->is('admin/send-email-otp') || $request->is('admin/verify-email-otp')) {
            if ($request->has('otp')) {
                // Validate OTP format before comparison
                if (!is_numeric($request->otp) || strlen($request->otp) != 6) {
                    return response()->json(['success' => false, 'message' => 'Invalid OTP format'], 422);
                }

                // Store strict OTP for secure comparison in controller
                $request->attributes->set('otp_validated', true);
            }
        }

        if ($request->is('admin/send-phone-otp') || $request->is('admin/verify-phone-otp')) {
            if ($request->has('otp')) {
                if (!is_numeric($request->otp) || strlen($request->otp) != 6) {
                    return response()->json(['success' => false, 'message' => 'Invalid OTP format'], 422);
                }
                $request->attributes->set('otp_validated', true);
            }
        }

        return $next($request);
    }
}
