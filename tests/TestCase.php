<?php 

namespace Sreedev\MailChimp\Tests;

use Sreedev\MailChimp\MailChimpServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{

    public function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            MailChimpServiceProvider::class
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        
    }

}