<?php

use App\Models\Course;
use GuzzleHttp\Promise\Create;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('only returns released courses for released scope', function () {
    // Arrange
    Course::factory()->released()->create();
    Course::factory()->create();

    // Art & Assert
    expect(Course::released()->get())
    ->toHaveCount(1)
    ->first()
    ->id
    ->toEqual(1);
});