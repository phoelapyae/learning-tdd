<?php

use App\Models\Course;
use App\Models\Video;

use function Pest\Laravel\get;
use function Pest\Laravel\withoutExceptionHandling;

it('does not find unreleased course', function () {
    // Arrange
    $course = Course::factory()->create();

    // Act & Assert
    get(route('pages.course-details', $course))
    ->assertNotFound();
});


it('shows course details', function () {
    withoutExceptionHandling();
    // Arrange
    $course = Course::factory()->released()->create();

    // Act & Assert
    get(route('pages.course-details', $course))
        ->assertOk()
        ->assertSeeText([
            $course->title,
            $course->description,
            $course->tagline,
            ...$course->learnings
        ])
        ->assertSee(asset("images/$course->image_name"));
});

it('shows course video count', function () {
    
    $course = Course::factory()
        ->has(Video::factory()->count(3))
        ->released()
        ->create();

    // Act & Assert
    get(route('pages.course-details', $course))->assertOk()->assertSeeText('3 videos');
});