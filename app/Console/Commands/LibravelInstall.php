<?php

// app/Console/Commands/LibravelInstall.php

namespace App\Console\Commands;

use App\Models\SiteInfo;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Process;

class LibravelInstall extends Command
{
    protected $signature = 'libravel:install';
    protected $description = 'Install and set up the application with default configurations.';

    public function handle()
    {
        $this->info("\n🚀 Starting Libravel Installation...\n");
        $this->runProcessWithLoading('npm install', 'Installing Node dependencies');

        if (!File::exists(base_path('.env'))) {
            $this->info('🔍 .env file not found. Copying from .env.example...');
            File::copy(base_path('.env.example'), base_path('.env'));
            $this->info('✅ .env file copied successfully.');
        }

        $appName = $this->ask('What is the name of your application?');
        $appName = str_replace(' ', '-', $appName);
        $this->updateEnv('APP_NAME', $appName);
        $this->runProcessWithLoading('php artisan key:generate', 'Generating application key');
        $this->runProcessWithLoading('php artisan storage:link', 'Creating storage symlink');
        $this->runProcessWithLoading('php artisan license:generate', 'Generating application license');

        $this->info("\n🎉 Installation Successful! Your project is ready to go.\n");
        $this->info("1. You should run 'php artisan migrate' and 'php artisan db:seed' to set up the database.");
        $this->info("2. Run 'php artisan serve' to start the server.");
        $this->info("3. Run 'npm run dev' to compile assets.\n");
        $this->info("4. You can run 'php artisan libravel:generate-info' to set up your site.\n");
    }

    protected function runProcessWithLoading($command, $message)
    {
        $this->output->write("<info>🔄 $message...</info> ");

        $process = Process::run($command);

        if ($process->successful()) {
            $this->output->write("\e[32m✔\e[0m\n");
        } else {
            $this->output->write("\e[31m✖\e[0m\n");
            $this->error("❌ Failed: $message\n" . $process->errorOutput());
            exit(1);
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
            $this->info("✅ Updated .env: $key=$value");
        } else {
            $this->error('.env file not found!');
        }
    }

    protected function addDefaultSiteInfo()
    {
        $this->info('🛠 Setting up default site information...');
        cache()->forget('site_info');

        SiteInfo::updateOrCreate(
            ['is_default' => true],
            [
                'shortname' => 'libravel_',
                'fullname' => 'Libravel',
                'url' => 'https://getlibravel.com',
                'description' => 'Libravel: Simplifying Library Management.',
                'email' => 'info@libravel.com',
                'phone' => '+1 555 555 5555',
                'is_default' => true,
            ]
        );

        $this->info("✅ Default site info set!");
    }
}
