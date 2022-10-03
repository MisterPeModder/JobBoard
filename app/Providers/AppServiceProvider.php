<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('svg', function ($arguments) {
            // Funky madness to accept multiple arguments into the directive
            list($path, $class) = array_pad(explode(',', trim($arguments, '() ')), 2, '');

            return $this->embedSvg(trim($path, "' "), trim($class, "' "));
        });
    }

    /**
     * Reads a SVG file and returns its contents as an embeddable string.
     */
    private function embedSvg(string $path, string $class): string | false
    {
        // Create the dom document as per the other answers
        $svg = new \DOMDocument();
        $svg->load(Vite::asset($path));
        $svg->documentElement->setAttribute('class', $class);
        $output = $svg->saveXML($svg->documentElement);

        return $output;
    }
}
