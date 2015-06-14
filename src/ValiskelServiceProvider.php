<?php namespace Ilyes512\Valiskel;

use Illuminate\Support\ServiceProvider;

class ValiskelServiceProvider extends ServiceProvider
{

    public function boot()
    {
        // Validation messages
        $this->app->bind('App\Services\Validators\Messages\MessagesInterface',
            'App\Services\Validators\Messages\MessageBag');
    }

    public function register()
    {
    }
}
