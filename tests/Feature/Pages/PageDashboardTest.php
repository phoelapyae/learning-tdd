<?php

use App\Models\Course;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Sequence;

use function Pest\Laravel\get;

it('cannot be accessed by guest', function () {
    // Act & Assert
    get(route('page.dashboard'))->assertRedirect(route('login'));
});

it('lists purchased courses', function () {
    // Arrange
    $user = User::factory()
    ->has(Course::factory()->count(2)->state(
        new Sequence(
            ['title' => 'Course A'],
            ['title' => 'Course B'],
        )
    ))
    ->create();

    // Act
    $this->actingAs($user);

    // Assert
    get(route('page.dashboard'))
    ->assertOk()
    ->assertSeeText([
        'Course A',
        'Course B'
    ]);
});

it('does not list other courses', function () {
    // Arrange
    $user = User::factory()->create();

    $course = Course::factory()->create();

    // Act & Assert
    $this->actingAs($user);

    get(route('page.dashboard'))
    ->assertOk()
    ->assertDontSeeText($course->title);
});

it('shows latest purchased course first', function () {
    // Arrange
    $user = User::factory()->create();

    $firstPurchasedCourse = Course::factory()->create();

    $lastPurchasedCourse = Course::factory()->create();

    $user->courses()->attach($firstPurchasedCourse, ['created_at' => Carbon::yesterday()]);
    $user->courses()->attach($lastPurchasedCourse, ['created_at' => Carbon::now()]);

    // Act & Assert
    $this->actingAs($user);

    get(route('page.dashboard'))
    ->assertOk()
    ->assertSeeInOrder([
        $lastPurchasedCourse->titile,
        $firstPurchasedCourse->title
    ]);
});

it('includes link to product video', function () {
    // Arrange
    $user = User::factory()
        ->has(Course::factory())
        ->create();

    // Act & Assert
    $this->actingAs($user);

    get(route('page.dashboard'))
    ->assertOk()
    ->assertSeeText('Watch videos')
    ->assertSee(route('page.course-videos', Course::first()));
});

it('includes logout', function () {
    //Act & Assert
    loginAsUser();
    get(route('page.dashboard'))
    ->assertOk()
    ->assertSeeText('Log Out')
    ->assertSee(route('logout'));
});