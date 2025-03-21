<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Idunno extends Command
{
    protected $signature = 'license:generate {--expires=6}';
    protected $description = 'Generate encrypted license file';

    public function handle()
    {
        $expirationDate = \Carbon\Carbon::now()->addMonth((int) $this->option('expires'))->timestamp;
        $secretKey = config('app.key');

        $encryptedLicense = encrypt($expirationDate, false);

        \Illuminate\Support\Facades\Storage::disk('local')->put('license.key', $encryptedLicense);

        $this->info('License file generated successfully!');
    }
}
