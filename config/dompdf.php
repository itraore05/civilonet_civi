<?php

return [
    'show_warnings' => false,
    'orientation' => 'portrait',
    'defines' => [
        'font_dir' => storage_path('fonts/'),
        'font_cache' => storage_path('fonts/'),
        'temp_dir' => storage_path('framework/views/'),
        'chroot' => realpath(base_path()),
        'enable_font_subsetting' => true,
        'pdf_backend' => 'auto', // 'auto' essaiera GD puis CPDF si Imagick n'est pas disponible
        'default_media_type' => 'screen',
        'default_paper_size' => 'a4',
        'default_font' => 'dejavu sans', // Police plus fiable
        'dpi' => 96,
        'enable_php' => false,
        'enable_javascript' => true,
        'enable_remote' => true,
        'font_height_ratio' => 1.1,
        'enable_html5_parser' => true,
    ]
];