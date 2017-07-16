<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
        $client = app(Client::class);
        $index = ['index' => env('ES_INDEX')];
        if(!$client->indices()->exists($index)){
            $client->indices()->create($index);
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Client::class, function(){
            return ClientBuilder::create()->build();
        });
    }
}
