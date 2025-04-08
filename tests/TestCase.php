<?php

namespace Tests;

use Http;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    //

    public function setUp(): void
    {
        parent::setUp();

        // Fake the pwnedpasswords.com API to skip uncompromised password checks
        Http::fake([
            'https://api.pwnedpasswords.com/range/*' => Http::response('', 200),
        ]);
    }
}
