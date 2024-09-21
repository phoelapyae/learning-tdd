<?php

use App\Models\Course;
use App\Models\User;
use App\Models\Video;

use function Pest\Laravel\get;

it('give back successful response from home page', function () {
    get(route('pages.home'))->assertOk();
});

it('gives back successful response for course detail page', function () {
    // Arrange
    $course = Course::factory()->released()->create();
    
    // Act & Assert
    get(route('pages.course-details', $course))->assertOk();
});

it('gives back successful response from dashboard page', function () {
    // Act & Assert
    loginAsUser();
    get(route('page.dashboard'))->assertOk();
});

it('does not find jetstream registration page', function () {
    //Act & Assert
    get('register')->assertNotFound();
});

it('gives successfully response for videos page', function () {
    // Arrange
    $course = Course::factory()->has(Video::factory())->create();

    // Act & Assert
    loginAsUser();
    get(route('page.course-videos', $course))->assertOk();
});