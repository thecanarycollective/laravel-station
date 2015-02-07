<?php namespace Canary\Station;

use Illuminate\Support\ServiceProvider;
use Config;

class StationServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->publishes([__DIR__.'/../../../public/' => base_path('/public/packages/canary/station'), 'public']);
		$this->publishes([__DIR__.'/../../config/' => base_path('/config/packages/canary/station'), 'config']);
		$this->loadViewsFrom(__DIR__.'/../../views/', 'station');
		include __DIR__.'/../../routes.php';
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		//

		$this->registerStationBuild();

		$this->commands('station:build');
	}

	/**
     * Register generate:model
     *
     * @return Commands\ModelGeneratorCommand
     */
    protected function registerStationBuild()
    {
            $this->app['station:build'] = $this->app->share(function($app)
            {
                    //$cache = new Cache($app['files']);
                    //$generator = new Generators\ModelGenerator($app['files'], $cache);

                    return new Commands\Build;
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