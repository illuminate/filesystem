<?php namespace Illuminate;

use Illuminate\Support\ServiceProvider;

class FilesystemServiceProvider extends ServiceProvider {

	/**
	 * Register the service provider.
	 *
	 * @param  Illuminate\Foundation\Application  $app
	 * @return void
	 */
	public function register($app)
	{
		$app['files'] = $app->share(function() { return new Filesystem; });
	}

}