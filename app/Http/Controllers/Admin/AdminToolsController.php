<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactForm;
use App\Models\Course;
use App\Models\CourseNote;
use App\Models\Payment;
use App\Models\Student;
use App\Models\StudentAdmission;
use App\Support\AdminPanel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Read-only helpers for the admin top bar and list pages:
 *   search   — one box that finds students, admissions, payments, messages, courses, notes
 *   related  — the links that connect one record to the rest of the same student's records
 * Neither endpoint changes any data.
 */
class AdminToolsController extends Controller
{
    public function search(Request $request): JsonResponse
    {
        $data = $request->validate(['q' => 'required|string|min:2|max:80']);
        $term = '%'.addcslashes(trim($data['q']), '%_\\').'%';
        $groups = [];

        $add = function (string $group, string $icon, iterable $rows) use (&$groups) {
            $items = [];
            foreach ($rows as $row) {
                $items[] = $row;
            }
            if ($items) {
                $groups[] = ['group' => $group, 'icon' => $icon, 'items' => $items];
            }
        };

        $this->guard(function () use ($add, $term) {
            $rows = Student::where('deleted', 0)
                ->where(fn ($q) => $q->where('name', 'like', $term)->orWhere('username', 'like', $term)->orWhere('email', 'like', $term))
                ->orderBy('name')->limit(6)->get(['id', 'name', 'username', 'email']);
            $add('Students', 'users', $rows->map(fn ($s) => [
                'title' => $s->name, 'sub' => trim($s->username.' · '.$s->email, ' ·'), 'url' => route('admin.viewstudent', $s->id),
            ]));
        });

        $this->guard(function () use ($add, $term) {
            $rows = StudentAdmission::where('deleted', 0)
                ->where(fn ($q) => $q->where('full_name', 'like', $term)->orWhere('admno', 'like', $term)
                    ->orWhere('phone', 'like', $term)->orWhere('email', 'like', $term))
                ->orderBy('full_name')->limit(6)->get(['id', 'full_name', 'admno', 'phone', 'admission_status']);
            $add('Admissions', 'file-text', $rows->map(fn ($a) => [
                'title' => $a->full_name, 'sub' => trim(($a->admno ?: 'No admission no.').' · '.$a->phone, ' ·'),
                'badge' => $a->admission_status ?: 'pending', 'url' => route('admin.showadmission', $a->id),
            ]));
        });

        $this->guard(function () use ($add, $term) {
            $rows = Payment::where('deleted', 0)
                ->where(fn ($q) => $q->where('invoice_number', 'like', $term)->orWhere('to_name', 'like', $term)->orWhere('to_email', 'like', $term))
                ->latest('id')->limit(6)->get(['id', 'invoice_number', 'to_name', 'payment_status', 'grand_total']);
            $add('Payments', 'credit-card', $rows->map(fn ($p) => [
                'title' => $p->to_name ?: $p->invoice_number, 'sub' => $p->invoice_number.' · ₹'.number_format((float) $p->grand_total, 2),
                'badge' => $p->payment_status, 'url' => route('admin.editpayment', $p->id),
            ]));
        });

        $this->guard(function () use ($add, $term) {
            $rows = ContactForm::where('delete', 1)
                ->where(fn ($q) => $q->where('first_name', 'like', $term)->orWhere('last_name', 'like', $term)
                    ->orWhere('email', 'like', $term)->orWhere('phone', 'like', $term))
                ->latest('id')->limit(5)->get(['id', 'first_name', 'last_name', 'email', 'service_type']);
            $add('Contact messages', 'inbox', $rows->map(fn ($c) => [
                'title' => trim($c->first_name.' '.$c->last_name), 'sub' => trim($c->email.' · '.$c->service_type, ' ·'), 'url' => route('admin.viewcontactform', $c->id),
            ]));
        });

        $this->guard(function () use ($add, $term) {
            $rows = Course::where('delete', 1)->where('title', 'like', $term)->orderBy('title')->limit(5)->get(['id', 'title', 'price']);
            $add('Courses', 'book-open', $rows->map(fn ($c) => [
                'title' => $c->title, 'sub' => $c->price ? '₹'.number_format((float) $c->price, 2) : '', 'url' => route('admin.listcourse').'#find='.rawurlencode($c->title),
            ]));
        });

        $this->guard(function () use ($add, $term) {
            $rows = CourseNote::where('delete', 1)->where('title', 'like', $term)->orderBy('title')->limit(5)->get(['id', 'title']);
            $add('Course notes', 'file', $rows->map(fn ($n) => [
                'title' => $n->title, 'sub' => 'Course note', 'url' => route('admin.listnotes').'#find='.rawurlencode($n->title),
            ]));
        });

        return response()->json(['q' => $data['q'], 'groups' => $groups]);
    }

    public function related(Request $request, AdminPanel $panel): JsonResponse
    {
        $data = $request->validate([
            'type' => 'required|in:student,admission,payment,contact',
            'id' => 'required|integer|min:1',
        ]);

        return response()->json(['items' => $panel->related($data['type'], (int) $data['id'])]);
    }

    private function guard(callable $fn): void
    {
        try {
            $fn();
        } catch (\Throwable $e) {
            report($e);
        }
    }
}
