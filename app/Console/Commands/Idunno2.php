<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;
use Illuminate\Console\Command;

class Idunno2 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'libravel:key';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $licenseServerUrl = env('LICENSE_SERVER_URL');

        try {
            $response = Http::post("$licenseServerUrl/generate-license", [
                'assigned_to' => env('APP_NAME', 'libravel_'),
                'expires_in' => 6
            ]);

            if ($response->successful()) {
                $this->info('License generated successfully!');
                $licenseKey = $response->json('license_key');
                if ($licenseKey) {
                    $this->saveLicenseKeyToEnv($licenseKey);
                } else {
                    $this->error('License key not found in the response.');
                }
            } else {
                $this->warn('License server unreachable or returned an error. Proceeding without a license.');
            }
        } catch (\Exception $e) {
            $this->warn('Failed to reach license server: ' . $e->getMessage());
        }
    }

    protected function updateEnv($key, $value)
    {
        $envFilePath = base_path('.env');

        if (File::exists($envFilePath)) {
            $envContents = File::get($envFilePath);
            $value = str_replace(' ', '', $value);

            if (preg_match("/^$key=/m", $envContents)) {
                $envContents = preg_replace("/^$key=.*/m", "$key=$value", $envContents);
            } else {
                $envContents .= "\n$key=$value";
            }

            File::put($envFilePath, $envContents);
        } else {
            $this->error('.env file not found!');
        }
    }

    /**
     * Save the generated license key to .env file.
     *
     * @param string $licenseKey
     * @return void
     */
    protected function saveLicenseKeyToEnv($licenseKey)
    {
        $this->updateEnv('APP_LICENSE_KEY', $licenseKey);
    }
}
