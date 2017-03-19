<?php

namespace App\Http\Controllers\Courses;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CourseStorylineController extends Controller {

    public function index(Course $course) {
        return view('lecturer.storylines.single', ['course' => $course]);
    }

}
