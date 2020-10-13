<?php

namespace App\Providers;

use Inertia\Inertia;
use App\Youtube\YoutubeServices;
use Illuminate\Support\Facades\Session;
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
        Inertia::share('flash', function () {
            return [
                'success' => Session::get('success'),
            ];
        });

        Inertia::share([
            'errors' => function () {
                return Session::get('errors')
                    ? Session::get('errors')->getBag('default')->getMessages()
                    : (object) [];
            },
        ]);

        $this->app->singleton('App\Youtube\YoutubeServices', function () {
            return new YoutubeServices(env('YOUTUBE_API_KEY'));
        });
    }
}
