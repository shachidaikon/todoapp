<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

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
        if (env('APP_SCHEME') == 'https') {
            $url->forceScheme('https');
            $this->app['request']->server->set('HTTPS', true);
        }
        // Inertia::share([
        //     'errors' => function () {
        //         return Session::get('errors')
        //             ? Session::get('errors')->getBag('default')->getMessages()
        //             : (object) [];
        //     },
        // ]);
  
        // Inertia::share('flash', function () {
        //     return [
        //         'message' => Session::get('message'),
        //     ];
        // });
    }
}
