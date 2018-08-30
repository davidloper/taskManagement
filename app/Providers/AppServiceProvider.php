<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Schema;

use App\Task;
use App\Notification;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        schema::defaultStringLength(191);

        Task::observe(\App\Observers\TaskObserver::class);

        $this->notifications();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
    public function notifications(){
    view()->composer('navbars.navbar', function() {
        $notifications = Notification::notSeen()->project()->limit(10)->get();
        view()->share('notifications', $notifications);
    });
  }
}
