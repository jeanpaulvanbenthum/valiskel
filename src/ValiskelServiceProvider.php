<?php namespace Ilyes512\Valiskel;

use Illuminate\Support\ServiceProvider;

class ValiskelServiceProvider extends ServiceProvider
{

    public function boot()
    {
        // Validation messages
        $this->app->bind('Ilyes512\Valiskel\Messages\MessagesInterface',
            'Ilyes512\Valiskel\Messages\MessageBag');
    }

    public function register()
    {
    }
}
