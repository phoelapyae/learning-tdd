<h1>{{ $course->title }}</h1>
<h1>{{ $course->tagline }}</h1>
<p>{{ $course->description }}</p>
<p>{{ $course->videos_count }} videos</p>

<ul>
    @foreach ($course->learnings as $learning)
        <li>{{ $learning }}</li>
    @endforeach
</ul>

<img src="{{ asset("images/$course->image_name") }}" alt="">