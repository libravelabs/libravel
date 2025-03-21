<?php

return [
    'home' => 'Beranda',
    'browse' => [
        'title' => 'Jelajah',
        'subtitle' => 'Link Cepat',
        'subject' => [
            'label' => 'Buku Pelajaran',
            'desc' => 'Jelajahi buku pelajaran berdasarkan pelajaran.',
            'page' => [
                'label' => 'buku berdasarkan pelajaran'
            ]
        ],
        'trending' => [
            'label' => 'Sedang Tren',
            'desc' => 'Temukan buku yang sedang populer saat ini.'
        ],
        'random_books' => [
            'label' => 'Buku Acak',
            'desc' => 'Biarkan sistem memilihkan buku acak untuk Anda.',
            'page' => [
                'label' => 'buku acak'
            ]
        ],
        'genre' => [
            'label' => 'Genre',
            'desc' => 'Jelajahi buku berdasarkan genre dan temukan favorit Anda.'
        ],
    ],
    'about' => 'Tentang Kami',
    'github' => 'Github Kami',
    'menus' => [
        'dashboard' => 'Dashboard Admin',
        'profile' => 'Profil',
        'account_settings' => 'Pengaturan Akun',
        'read_later' => 'Daftar Bacaan',
        'theme' => 'Tema',
        'language' => 'Bahasa',
        'signout' => 'Keluar'
    ],
    'links' => [
        'general' => 'Umum',
        'security' => 'Keamanan',
        'discover' => 'Jelajah',
        'favorite' => 'Favorit'
    ],
    'action' => [
        'get_started' => 'Mulai sekarang'
    ],
    'jumbotron' => [
        'find_some_book' => 'Temukan Beberapa Buku',
        'subtitle_1' => 'Cari, baca, dan unduh',
        'find_your_own' => 'Temukan milikmu sendiri',
        'subtitle_2' => 'Saatnya mencoba',
    ],
    'search' => [
        'title' => 'Pencarian cepat',
        'desc' => 'Cari buku, penulis, dan penerbit apa saja',
        'no_results' => 'Tidak ada hasil untuk',
        'no_recent' => 'Tidak ada riwayat pencarian',
        'to_close' => 'untuk menutup',
        'models' => [
            'book' => 'Buku',
            'author' => 'Penulis',
            'publisher' => 'Penerbit',
            'collection' => 'Koleksi'
        ]
    ],
    'loading' => 'Memuat',

    'footer' => [
        'project_created_with' => 'Proyek ini dibuat dan dirancang dengan',
        'by' => 'oleh',
        'and' => 'dan',
        'powered_by' => 'Dikembangkan dengan',
        'laravel' => 'Laravel',
        'filament' => 'FilamentPHP',
        'livewire' => 'Laravel Livewire',
        'tailwind' => 'Tailwind CSS',
        'alpine' => 'Alpine JS',
        'rights_reserved' => '© 2024-2025 Libravel Inc.',
    ],

    'show_more' => 'Lebih banyak',
    'show_less' => 'Lebih sedikit',

    'errors' => [
        '400' => [
            'heading' => 'Permintaan Buruk',
            'content' => 'Server tidak dapat memahami permintaan karena sintaks yang tidak valid.'
        ],
        '403' => [
            'heading' => 'Terlarang',
            'content' => 'Anda tidak memiliki izin untuk mengakses sumber daya yang diminta.'
        ],
        '404' => [
            'heading' => 'Tidak Ditemukan',
            'content' => 'Halaman yang Anda cari tidak dapat ditemukan.'
        ],
        '419' => [
            'heading' => 'Halaman Kedaluwarsa',
            'content' => 'Sesi Anda telah kedaluwarsa. Silakan muat ulang halaman dan coba lagi.'
        ],
        '500' => [
            'heading' => 'Ups! Terjadi kesalahan di pihak kami',
            'content' => 'Silakan coba lagi nanti'
        ]
    ]
];
