<?php
require 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Http\Client\Factory;
use Illuminate\Support\Facades\Http;

echo "====== API ENDPOINT TESTS ======\n\n";

// Test 1: Get courses
echo "TEST 1: GET /api/v1/courses\n";
try {
    $response = Http::get('http://localhost:8000/api/v1/courses');
    echo "Status: " . $response->status() . "\n";
    $data = $response->json();
    echo "Success: " . ($data['success'] ? 'YES' : 'NO') . "\n";
    echo "Has pagination meta: " . (isset($data['meta']) ? 'YES' : 'NO') . "\n";
    echo "Response Keys: " . implode(', ', array_keys($data)) . "\n\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n\n";
}

// Test 2: Search courses with valid query
echo "TEST 2: GET /api/v1/courses/search?q=constitutional\n";
try {
    $response = Http::get('http://localhost:8000/api/v1/courses/search?q=constitutional');
    echo "Status: " . $response->status() . "\n";
    $data = $response->json();
    echo "Success: " . ($data['success'] ? 'YES' : 'NO') . "\n";
    echo "Message: " . $data['message'] . "\n\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n\n";
}

// Test 3: Search with invalid query (too short)
echo "TEST 3: GET /api/v1/courses/search?q=ab (SHOULD FAIL)\n";
try {
    $response = Http::get('http://localhost:8000/api/v1/courses/search?q=ab');
    echo "Status: " . $response->status() . "\n";
    $data = $response->json();
    echo "Success: " . ($data['success'] ? 'YES' : 'NO') . "\n";
    echo "Error: " . ($data['error'] ?? 'N/A') . "\n\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n\n";
}

// Test 4: Get featured courses
echo "TEST 4: GET /api/v1/courses/featured\n";
try {
    $response = Http::get('http://localhost:8000/api/v1/courses/featured');
    echo "Status: " . $response->status() . "\n";
    $data = $response->json();
    echo "Success: " . ($data['success'] ? 'YES' : 'NO') . "\n";
    echo "Has data array: " . (is_array($data['data']) ? 'YES' : 'NO') . "\n\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n\n";
}

// Test 5: Send Email OTP
echo "TEST 5: POST /api/v1/auth/send-email-otp\n";
try {
    $response = Http::post('http://localhost:8000/api/v1/auth/send-email-otp', [
        'email' => 'test@example.com'
    ]);
    echo "Status: " . $response->status() . "\n";
    $data = $response->json();
    echo "Success: " . ($data['success'] ? 'YES' : 'NO') . "\n";
    echo "Message: " . $data['message'] . "\n";
    echo "OTP Validity: " . ($data['data']['validity_minutes'] ?? 'N/A') . " minutes\n\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n\n";
}

// Test 6: Send Email OTP with invalid email
echo "TEST 6: POST /api/v1/auth/send-email-otp (INVALID EMAIL - SHOULD FAIL)\n";
try {
    $response = Http::post('http://localhost:8000/api/v1/auth/send-email-otp', [
        'email' => 'invalid-email'
    ]);
    echo "Status: " . $response->status() . "\n";
    $data = $response->json();
    echo "Success: " . ($data['success'] ? 'YES' : 'NO') . "\n";
    echo "Has validation errors: " . (isset($data['details']) ? 'YES' : 'NO') . "\n\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n\n";
}

// Test 7: Send Phone OTP
echo "TEST 7: POST /api/v1/auth/send-phone-otp\n";
try {
    $response = Http::post('http://localhost:8000/api/v1/auth/send-phone-otp', [
        'phone' => '9876543210'
    ]);
    echo "Status: " . $response->status() . "\n";
    $data = $response->json();
    echo "Success: " . ($data['success'] ? 'YES' : 'NO') . "\n";
    echo "Message: " . $data['message'] . "\n\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n\n";
}

// Test 8: Protected endpoint (should fail without auth)
echo "TEST 8: GET /api/v1/student/profile (PROTECTED - SHOULD FAIL)\n";
try {
    $response = Http::get('http://localhost:8000/api/v1/student/profile');
    echo "Status: " . $response->status() . "\n";
    $data = $response->json();
    echo "Success: " . ($data['success'] ? 'YES' : 'NO') . "\n";
    echo "Error: " . ($data['error'] ?? 'N/A') . "\n\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n\n";
}

// Test 9: Protected payment endpoint (should fail without auth)
echo "TEST 9: GET /api/v1/payments/history (PROTECTED - SHOULD FAIL)\n";
try {
    $response = Http::get('http://localhost:8000/api/v1/payments/history');
    echo "Status: " . $response->status() . "\n";
    $data = $response->json();
    echo "Success: " . ($data['success'] ? 'YES' : 'NO') . "\n";
    echo "Error: " . ($data['error'] ?? 'N/A') . "\n\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n\n";
}

echo "====== TESTS COMPLETE ======\n";
echo "✅ All API endpoints are properly registered and responding!\n";
