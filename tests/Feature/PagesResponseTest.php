<?php

use function Pest\Laravel\get;

test('give back successful response from home page', function () {
    get(route('home'))->assertOk();
});