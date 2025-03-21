<?php

return [
    'home' => 'Home',
    'browse' => [
        'title' => 'Browse',
        'subtitle' => 'Quick Links',
        'subject' => [
            'label' => 'Subject',
            'desc' => 'Browse educational books by subject.',
            'page' => [
                'label' => 'books by subject'
            ]
        ],
        'trending' => [
            'label' => 'Trending',
            'desc' => 'Discover the most popular books at the moment.',
        ],
        'random_books' => [
            'label' => 'Random Books',
            'desc' => 'Let the system pick a random book for you.',
            'page' => [
                'label' => 'random books'
            ]
        ],
        'genre' => [
            'label' => 'Genre',
            'desc' => 'Explore books by their genre and find your favorites.'
        ],
    ],
    'about' => 'About Us',
    'github' => 'Our Github',
    'menus' => [
        'dashboard' => 'Admin Dashboard',
        'profile' => 'Profile',
        'account_settings' => 'Account Settings',
        'read_later' => 'Read Later',
        'theme' => 'Theme',
        'language' => 'Language',
        'signout' => 'Sign out'
    ],
    'links' => [
        'general' => 'General',
        'security' => 'Security',
        'discover' => 'Discover',
        'favorite' => 'Favorite'
    ],
    'action' => [
        'get_started' => 'Get Started'
    ],
    'jumbotron' => [
        'find_some_book' => 'Find Some Book',
        'subtitle_1' => 'Search it, read it, download it',
        'find_your_own' => 'Find your own',
        'subtitle_2' => "It's time to try"
    ],
    'search' => [
        'title' => 'Quick search',
        'desc' => 'Search for any books, authors, and publishers',
        'no_results' => 'No results for',
        'no_recent' => 'No recent searches',
        'to_close' => 'to close',
        'models' => [
            'book' => 'Books',
            'author' => 'Authors',
            'publisher' => 'Publishers',
            'collection' => 'Collections'
        ]
    ],
    'loading' => 'Loading',

    'footer' => [
        'project_created_with' => 'This project is created and crafted with',
        'by' => 'by',
        'and' => 'and',
        'powered_by' => 'Cooked up with',
        'laravel' => 'Laravel',
        'filament' => 'FilamentPHP',
        'livewire' => 'Laravel Livewire',
        'tailwind' => 'Tailwind CSS',
        'alpine' => 'Alpine JS',
        'rights_reserved' => '© 2024-2025 Libravel Inc.',
    ],

    'show_more' => 'Show more',
    'show_less' => 'Show less',

    'errors' => [
        '400' => [
            'heading' => 'Bad Request',
            'content' => 'The server could not understand the request due to invalid syntax.'
        ],
        '403' => [
            'heading' => 'Forbidden',
            'content' => 'You do not have access to the requested resource.'
        ],
        '404' => [
            'heading' => 'Sorry, the page you are looking for could not be found',
            'content' => 'Please try again later'
        ],
        '419' => [
            'heading' => 'Page Expired',
            'content' => 'Your session has expired. Please refresh the page and try again.'
        ],
        '500' => [
            'heading' => 'Oops! Something went wrong on our end',
            'content' => 'Please try again later'
        ]
    ]
];
