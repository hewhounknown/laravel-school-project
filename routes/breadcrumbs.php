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
Breadcrumbs::for('courseDetail', function (BreadcrumbTrail $trail, $courseName) {
    $trail->push($courseName, route('courseDetail', ['name' => $courseName]));
});



// Course/Topic/content
Breadcrumbs::for('contentView', function ($trail, $topic, $content) {
    $trail->parent('courseDetail', $topic->course->course_name);
    $trail->push($topic->topic_name) ;
    $trail->push($content->title, route('contentView', ['name' => $topic->topic_name, 'title' => $content->title]));
});

