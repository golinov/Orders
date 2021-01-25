<?php

namespace Tests;

use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, DatabaseMigrations;

    protected $defaultHeaders;

    protected function setUp(): void
    {
        parent::setUp();
        $this->defaultHeaders = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];
    }
}
