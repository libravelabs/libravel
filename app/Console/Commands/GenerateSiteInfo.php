<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\SiteInfo;
use Illuminate\Support\Facades\Cache;

class GenerateSiteInfo extends Command
{
    protected $signature = 'libravel:generate-info';
    protected $description = 'Generate default Site Info interactively';

    public function handle()
    {
        $this->info("\n🌍 Generating Site Info...\n");

        $defaultInfo = SiteInfo::where('is_default', true)->first();
        if ($defaultInfo) {
            if (!$this->confirm('A default Site Info already exists. Overwrite?', false)) {
                $this->info("✅ Site Info generation skipped.");
                return;
            }
        }

        $shortname = $this->ask('Enter site shortname', 'libravel_');
        $fullname = $this->ask('Enter site fullname', 'Libravel');
        $url = $this->ask('Enter site url', 'https://getlibravel.com');
        $email = $this->ask('Enter contact email', 'info@libravel.com');
        $phone = $this->ask('Enter contact phone', '+1 (555) 555-5555');
        $description = $this->ask('Enter site description', 'Libravel is a modern web platform.');

        SiteInfo::where('is_default', true)->update(['is_default' => false]);

        $siteInfo = SiteInfo::updateOrCreate(
            ['shortname' => $shortname],
            [
                'fullname' => $fullname,
                'email' => $email,
                'url' => $url,
                'phone' => $phone,
                'description' => $description,
                'is_default' => true,
            ]
        );

        Cache::forget('site_info');
        Cache::rememberForever('site_info', fn() => $siteInfo);

        $this->info("\n✅ Site Info generated successfully!\n");
        $this->info("\nYou can make another or edit in admin panel\n");
    }
}
