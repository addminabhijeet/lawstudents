<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseApiController;
use App\Services\AuthenticationService;
use App\Exceptions\OtpException;
use Illuminate\Http\Request;

class AuthController extends BaseApiController
{
    protected AuthenticationService $authService;

    public function __construct(AuthenticationService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Send email OTP
     */
    public function sendEmailOtp(Request $request)
    {
        try {
            $validated = $request->validate([
                'email' => 'required|email:rfc,dns',
            ]);

            $result = $this->authService->sendEmailOtp($validated['email']);

            return $this->successResponse(
                data: $result,
                message: 'OTP sent to email'
            );
        } catch (OtpException $e) {
            return $this->errorResponse($e->getMessage(), $e->code, $e->code);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return $this->validationErrorResponse($e->errors());
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to send OTP', 'otp_error', 500);
        }
    }

    /**
     * Send phone OTP
     */
    public function sendPhoneOtp(Request $request)
    {
        try {
            $validated = $request->validate([
                'phone' => 'required|regex:/^[0-9]{10}$/',
            ]);

            $result = $this->authService->sendPhoneOtp($validated['phone']);

            return $this->successResponse(
                data: $result,
                message: 'OTP sent to phone'
            );
        } catch (OtpException $e) {
            return $this->errorResponse($e->getMessage(), $e->code, $e->code);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return $this->validationErrorResponse($e->errors());
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to send OTP', 'otp_error', 500);
        }
    }

    /**
     * Verify email OTP
     */
    public function verifyEmailOtp(Request $request)
    {
        try {
            $validated = $request->validate([
                'otp' => 'required|string|size:6|numeric',
            ]);

            $result = $this->authService->verifyEmailOtp($validated['otp']);

            return $this->successResponse(
                data: $result,
                message: 'Email verified successfully'
            );
        } catch (OtpException $e) {
            return $this->errorResponse($e->getMessage(), $e->code, $e->code);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return $this->validationErrorResponse($e->errors());
        } catch (\Exception $e) {
            return $this->errorResponse('Verification failed', 'verify_error', 500);
        }
    }

    /**
     * Verify phone OTP
     */
    public function verifyPhoneOtp(Request $request)
    {
        try {
            $validated = $request->validate([
                'otp' => 'required|string|size:6|numeric',
            ]);

            $result = $this->authService->verifyPhoneOtp($validated['otp']);

            return $this->successResponse(
                data: $result,
                message: 'Phone verified successfully'
            );
        } catch (OtpException $e) {
            return $this->errorResponse($e->getMessage(), $e->code, $e->code);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return $this->validationErrorResponse($e->errors());
        } catch (\Exception $e) {
            return $this->errorResponse('Verification failed', 'verify_error', 500);
        }
    }
}
