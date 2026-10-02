<?php

return [
    // Maximum file upload size in MB
    'max_upload_size_mb' => env('MAX_UPLOAD_SIZE_MB', 50),

    // Allowed document file types
    'allowed_document_types' => ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'txt'],

    // Allowed image file types
    'allowed_image_types' => ['jpg', 'jpeg', 'png', 'gif', 'webp'],

    // Storage disk
    'disk' => env('FILESYSTEM_DISK', 'local'),

    // Paths
    'paths' => [
        'course_notes' => 'uploads/course-notes',
        'course_materials' => 'uploads/course-materials',
        'student_documents' => 'uploads/student-documents',
        'admin_uploads' => 'uploads/admin',
        'gallery' => 'uploads/gallery',
        'temp' => 'uploads/temp',
    ],

    // Watermark settings
    'watermark' => [
        'enabled' => env('WATERMARK_ENABLED', true),
        'text' => 'Law Students Platform - For Licensed Use Only',
        'company_name' => 'Law Students',
        'logo' => 'assets/theme/images/logo-full-720.png',
        'website' => 'law.norloxsolutionscrm.com',
        'paid_opacity' => 0.08,
        'qpdf_binary' => env('PDF_QPDF_BINARY', is_file(storage_path('app/tools/qpdf-12.4.2-msvc64/bin/qpdf.exe'))
            ? storage_path('app/tools/qpdf-12.4.2-msvc64/bin/qpdf.exe') : 'qpdf'),
        'opacity' => 0.3,
        'position' => 'center',
    ],

    // Image optimization
    'image_optimization' => [
        'enabled' => true,
        'quality' => 85,
        'thumbnail_width' => 200,
        'thumbnail_height' => 150,
    ],

    // Virus scanning (if enabled)
    'virus_scan' => [
        'enabled' => env('VIRUS_SCAN_ENABLED', false),
        'service' => env('VIRUS_SCAN_SERVICE', 'clamav'),
    ],
];
