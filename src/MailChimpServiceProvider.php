<?php 
namespace Sreedev\MailChimp;

use Illuminate\Support\ServiceProvider;


class MailChimpServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {

            $this->publishes([
              __DIR__.'/../config/config.php' => config_path('mailchimp.php'),
            ], 'config');
        
        }
    }

    public function register()
    {
        $this->app->singleton('mailchimp', function($app){
            return new MailChimp(config('mailchimp.MAIL_CHIMP_API_KEY'));
        });
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'mailchimp'); 
    }
}