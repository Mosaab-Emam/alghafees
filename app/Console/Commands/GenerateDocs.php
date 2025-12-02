<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateDocs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'docs:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate API documentation with corrected asset paths';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Run the original scribe:generate command
        $this->info('Generating API documentation...');
        $this->call('scribe:generate');

        // Fix the asset paths in the generated file
        $this->info('Fixing asset paths...');
        $this->fixAssetPaths();

        $this->info('✅ Documentation generated successfully with corrected asset paths!');

        return Command::SUCCESS;
    }

    /**
     * Fix asset paths in the generated documentation file
     */
    protected function fixAssetPaths()
    {
        $docsPath = resource_path('views/scribe/index.blade.php');

        if (!File::exists($docsPath)) {
            $this->error('Documentation file not found at: ' . $docsPath);
            return;
        }

        $contents = File::get($docsPath);

        // Fix hardcoded localhost URLs in CSS
        $contents = preg_replace(
            '#href="https?://[^"]+/vendor/scribe/(css/[^"]+)"#',
            'href="{{ asset(\'vendor/scribe/$1\') }}"',
            $contents
        );

        // Fix relative CSS paths
        $contents = preg_replace(
            '#href="(?:\.\./docs/|scribe/)(css/[^"]+)"#',
            'href="{{ asset(\'vendor/scribe/$1\') }}"',
            $contents
        );

        // Fix hardcoded localhost URLs in JS
        $contents = preg_replace(
            '#src="https?://[^"]+/vendor/scribe/(js/[^"]+)"#',
            'src="{{ asset(\'vendor/scribe/$1\') }}"',
            $contents
        );

        // Fix relative JS paths
        $contents = preg_replace(
            '#src="(?:\.\./docs/|scribe/)(js/[^"]+)"#',
            'src="{{ asset(\'vendor/scribe/$1\') }}"',
            $contents
        );

        // Fix hardcoded localhost URLs in images
        $contents = preg_replace(
            '#src="https?://[^"]+/vendor/scribe/(images/[^"]+)"#',
            'src="{{ asset(\'vendor/scribe/$1\') }}"',
            $contents
        );

        // Fix relative image paths
        $contents = preg_replace(
            '#src="(?:\.\./docs/|scribe/)(images/[^"]+)"#',
            'src="{{ asset(\'vendor/scribe/$1\') }}"',
            $contents
        );

        File::put($docsPath, $contents);

        $this->info('Asset paths fixed in: ' . $docsPath);
    }
}

