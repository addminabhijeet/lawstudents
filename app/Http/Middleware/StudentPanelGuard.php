<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Keeps students to their own panel.
 *
 * routes/student.php also carries copies of admin actions. They load records by id
 * without checking whose they are, and their forms post to the admin routes, so no
 * student page uses them. Typed into the address bar they let a signed-in student:
 *  - list every student's invoices (list-payment);
 *  - open or rewrite anyone's invoice, amounts and issue date included, which can
 *    unlock courses (edit-payment, update-payment);
 *  - change anyone's name, email or password (edit-student, update-student);
 *  - open, change or delete anyone's admission, and approve their own
 *    (edit-admission, update-admission, destroy-admission, register-admission);
 *  - create student accounts, invoices, categories, courses and notes.
 * For students these now answer 404. The controllers are unchanged, and the admin
 * panel keeps its own routes (routes/admin.php) for all of this.
 */
class StudentPanelGuard
{
    /** Staff tools under /student (route names). */
    private const STAFF_ONLY = [
        'student.addstudent',
        'student.registerstusubmit',
        'student.editstudent',
        'student.updatestusubmit',
        'student.registeradmsubmit',
        'student.editadmission',
        'student.updateadmsubmit',
        'student.destroyadmission',
        'student.addpayment',
        'student.editpayment',
        'student.updatepayment',
        'student.listpayment',
        'student.storecategory',
        'student.storecourse',
        'student.storenotes',
    ];

    public function handle(Request $request, Closure $next): Response
    {
        if (in_array($request->route()?->getName(), self::STAFF_ONLY, true)) {
            abort(404);
        }

        return $next($request);
    }
}
