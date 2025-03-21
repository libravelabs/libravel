<?php

return [
    'page' => [
        'title' => 'Site Info',
    ],
    'shortname' => [
        'label' => 'Short App Name',
        'desc'  => 'Enter a short, unique name for your application, typically used in URLs and identifiers.',
    ],
    'fullname' => [
        'label' => 'Full App Name',
        'desc'  => 'Enter the full, formal name of your application, usually displayed in the app or marketing materials.',
    ],
    'url' => [
        'label' => 'Application URL',
        'desc'  => 'Enter the base URL of your application.',
    ],

    'email' => [
        'label' => 'App Email',
        'desc'  => 'Provide an email address for your application, used for notifications, support, and communication.',
    ],
    'phone' => [
        'label' => 'App Phone',
        'desc'  => 'Enter a contact phone number for your application, used for customer support or inquiries.',
    ],
    'description' => [
        'label' => 'Description',
        'desc'  => 'Provide a brief description of your application, highlighting its features and purpose.',
    ],
    'logo' => [
        'label' => 'App Logo',
        'desc'  => 'Upload a logo image for your application. This logo will be used in branding and visual identity.',
    ],
    'favicon' => [
        'label' => 'App Favicon',
        'desc'  => 'Upload a small icon (favicon) that represents your app in the browser tab.',
    ],
    'is_default' => [
        'label' => 'Set as Default',
        'desc'  => 'Only one Site Info can be set as the default. This will be the primary instance of your application.',
    ],

    'messages' => [
        'site_info_default' => 'At least one site info must be set as default.',
    ]
];
