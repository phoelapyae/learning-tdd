<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\get;

uses(RefreshDatabase::class);

test('give back successful response from home page', function () {
    get(route('home'))->assertOk();
});