<?php

namespace Database\Seeders;

use App\Models\SiteInfo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SiteInfo::create([
            'shortname' => 'libravel_',
            'fullname' => 'Libravel',
            'url' => 'https://getlibravel.com',
            'email' => 'info@libravel.com',
            'phone' => '0123456789',
            'is_default' => true,
        ]);
    }
}
