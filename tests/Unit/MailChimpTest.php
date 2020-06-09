<?php 

namespace Sreedev\MailChimp\Tests\Unit;

use Sreedev\MailChimp\Facades\MailChimp;
use Sreedev\MailChimp\Tests\TestCase;

class MailChimpTest extends TestCase
{
    /**@test */
    public function testValidAPIKey()
    {
        $this->expectException('\Exception');
        MailChimp::get('lists');

    }
}