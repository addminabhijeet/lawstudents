<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Models\MailSetting;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // ===== LOAD EXTRA ROUTE FILES (ADMIN + STUDENT) =====

        Route::middleware('web')
            ->group(base_path('routes/admin.php'));

        Route::middleware('web')
            ->group(base_path('routes/student.php'));

        Route::middleware('web')
            ->group(base_path('routes/auth.php')); {
            try {
                // Load mail settings from DB
                $mail = MailSetting::first();

                if ($mail) {

                    config([
                        'mail.default' => $mail->mail_mailer ?? 'smtp',

                        'mail.mailers.smtp.transport' => 'smtp',
                        'mail.mailers.smtp.host' => $mail->mail_host,
                        'mail.mailers.smtp.port' => $mail->mail_port,
                        'mail.mailers.smtp.username' => $mail->mail_username,
                        'mail.mailers.smtp.password' => $mail->mail_password,
                        'mail.mailers.smtp.encryption' => $mail->mail_encryption,

                        'mail.from.address' => $mail->mail_from_address,
                        'mail.from.name' => $mail->mail_from_name,
                    ]);
                }
            } catch (\Exception $e) {
                // Prevent crash if DB not ready (important during migration)
            }
        }
    }
}
