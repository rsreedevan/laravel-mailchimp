<?php
namespace Sreedev\MailChimp\Facades;

use Illuminate\Support\Facades\Facade;

class MailChimp extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'mailchimp';

    } 
}