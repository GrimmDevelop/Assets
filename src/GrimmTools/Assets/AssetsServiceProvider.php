<?php

namespace GrimmTools\LocationParser;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AssetsServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('grimmtools.assets', function($app) {
            return $app->make('GrimmTools\Assets\AssetsManager');
        });

        Blade::extend(function($view, $compiler) {
            $pattern = $compiler->createMatcher('asset');

            return preg_replace($pattern, '$1<?php echo \GrimmTools\Assets\Assets::group($2); ?>', $view);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

}