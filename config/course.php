<?php

return [
    // Course enrollment
    'enrollment' => [
        'allow_free_preview' => true,
        'free_preview_chapters' => 2,
        'free_preview_duration_days' => 7,
    ],

    // Course access
    'access' => [
        'require_payment' => true,
        'require_admission' => false,
        'auto_enroll_after_payment' => true,
    ],

    // Course content
    'content' => [
        'max_notes_per_chapter' => 50,
        'min_chapter_duration_minutes' => 5,
    ],

    // Refund policy
    'refund' => [
        'enabled' => true,
        'refund_window_days' => 7,
        'refund_percentage' => 100,
    ],
];
