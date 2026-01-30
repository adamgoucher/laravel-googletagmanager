<?php

namespace Spatie\GoogleTagManager;

use Illuminate\Config\Repository as ConfigRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\ServiceProvider;

class GoogleTagManagerServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'googletagmanager');

        $this->publishes([
            __DIR__.'/../resources/config/config.php' => $this->app->configPath('googletagmanager.php'),
        ], 'config');

        $this->publishes([
            __DIR__.'/../resources/views' => $this->app->basePath('resources/views/vendor/googletagmanager'),
        ], 'views');

        $this->app->make(Factory::class)->creator(
            ['googletagmanager::head', 'googletagmanager::body', 'googletagmanager::script'],
            'Spatie\GoogleTagManager\ScriptViewCreator'
        );
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../resources/config/config.php', 'googletagmanager');

        $this->app->scoped(GoogleTagManager::class, function (Application $app): GoogleTagManager {
            $googleTagManager = new GoogleTagManager(
                $app->make(ConfigRepository::class)->string('googletagmanager.id'),
                $app->make(ConfigRepository::class)->string('googletagmanager.domain'),
                $app->make(ConfigRepository::class)->boolean('googletagmanager.nonceEnabled'),
            );

            if ($app->make(ConfigRepository::class)->boolean('googletagmanager.enabled') === false) {
                $googleTagManager->disable();
            }

            return $googleTagManager;
        });

        $this->app->alias(GoogleTagManager::class, 'googletagmanager');
    }
}
