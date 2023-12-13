<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use App\Models\Topic;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use App\Models\Content;
use App\Models\Courses;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Course
Breadcrumbs::for('course', function (BreadcrumbTrail $trail,Courses $course) {
    $trail->push($course->course_name, route('courseDetail', $course));
});



// Course/Topic/content
Breadcrumbs::for('content', function ($trail, $topic, $content) {
    $trail->parent('course', $topic->course);
    $trail->push($topic->topic_name) ;
    $trail->push($content->title, route('contentView', ['name' => $topic->topic_name, 'title' => $content->title]));
});

