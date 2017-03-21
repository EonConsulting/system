<?php

namespace App\Http\Controllers\LTI\Courses;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CourseLectureLTIController extends Controller {

    public function index(Course $course, $storyline_item = false) {
        $data = storyline_core()->getIndex($course);

//        dd($data);

        $styles = [];
        $scripts = [];
        $custom_scripts = [];

        $nav = '';
        if(function_exists('storyline_nav')) {
            $nav = storyline_nav()->getNavHTMLFromCourse($course);
            dd($nav);
            $styles = array_merge($styles, storyline_nav()->getStyles());
            $scripts = array_merge($scripts, storyline_nav()->getScripts());
            $custom_scripts[] = storyline_nav()->getCustomScripts();
        }

        dd($nav);

        return view('lti.courses.lectures', ['data' => $data, 'course' => $course]);
    }

}
