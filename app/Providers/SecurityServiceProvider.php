<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\OtpSecurityService;
use App\Services\FileManagementService;

class SecurityServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Bind OTP Security Service as singleton
        $this->app->singleton('otp-security', function () {
            return OtpSecurityService::class;
        });

        // Bind File Management Service as singleton
        $this->app->singleton('file-management', function () {
            return FileManagementService::class;
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Register middleware
        $this->app['router']->aliasMiddleware('throttle.otp', \App\Http\Middleware\ThrottleOtpRequests::class);
        $this->app['router']->aliasMiddleware('validate.otp', \App\Http\Middleware\ValidateOtpSecurely::class);
    }
}
