<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public $userToken;

    protected function setUp(): void
    {
        parent::setUp();

        $appUrl = env('app_url');
        \URL::forceRootUrl("{$appUrl}/api/");

        $user = \App\Models\User::first();

        $this->userToken = $user ? $user->createToken('PAT')->plainTextToken : null;
    }
}
