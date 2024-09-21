<?php

use App\Models\Course;
use App\Models\Video;
use GuzzleHttp\Promise\Create;

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

test('has videos', function () {
    // Arrange
    $course = Course::factory()->create();
    Video::factory()->count(3)->create(['course_id' => $course->id]);

    // $Act & Assert
    expect($course->videos)
    ->toHaveCount(3)
    ->each
    ->toBeInstanceOf(Video::class);
});