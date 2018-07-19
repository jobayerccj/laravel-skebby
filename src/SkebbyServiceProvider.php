<?php
namespace jobayerccj\Skebby;
use Illuminate\Support\ServiceProvider;
class SkebbyServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
    }
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Skebby::class, function () {
            return new Skebby();
        });
        $this->app->alias(Skebby::class, 'skebby');
    }
}