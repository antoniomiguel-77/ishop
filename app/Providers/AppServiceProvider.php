<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Blade::directive("Money", function ($value): string {
            return "<?php echo 'Kz '. number_format($value,2,',',' ')?>";
        });

        Blade::directive("Qtd", function ($value): string {
            return "<?php echo  number_format($value,0,'','')?>";
        });


        Blade::directive('DateFormatter', function ($expression) {
            return "<?php echo \Carbon\Carbon::parse($expression)->locale('pt')->translatedFormat('d/m/Y'); ?>";
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
