<?php
require_once __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Http\Kernel')->handle(
    $request = Illuminate\Http\Request::capture()
);

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

$password = 'Student@Test123';
$hashedPassword = Hash::make($password);

// Update all student passwords
$updated = DB::table('users')
    ->where('role', 'student')
    ->update(['password' => $hashedPassword]);

echo "Updated $updated student passwords\n";
echo "New password: $password\n";
?>
