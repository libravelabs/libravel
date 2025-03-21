<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Banner::insert([
            [
                'title' => 'libravel_banner',
                'image_path' => '/banners/libravel_banner.png',
                'is_active' => true,
                'start_date' => now(),
                'end_date' => now()->addDays(7),
                'image_only' => true,
            ],
            [
                'title' => 'libravel_banner_2',
                'image_path' => '/banners/libravel_banner_2.png',
                'is_active' => true,
                'start_date' => now(),
                'end_date' => now()->addDays(7),
                'image_only' => true,
            ]
        ]);
    }
}
