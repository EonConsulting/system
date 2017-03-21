<?php

namespace App\Http\Controllers\LTI\Courses;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CoursesLTIController extends Controller {

    public function index() {
        $courses = Course::get();

        return view('lti.courses.list', ['courses' => $courses]);
    }

}
