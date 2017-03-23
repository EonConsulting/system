<?php

namespace App\Http\Controllers\LTI\Courses;

use App\Models\Course;
use App\Models\Storyline;
use App\Models\StorylineItem;
use EONConsulting\LaravelLTI\Http\Controllers\LTIBaseController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CourseLectureItemLTIController extends LTIBaseController {

    public function index(Course $course, StorylineItem $storylineItem) {

        $data = storyline_core()->getIndex($course);
        $storyline = $course->storylines()->first();

        $styles = [];
        $scripts = [];
        $custom_scripts = [];
        $custom_styles = [];

        $nav = '';
        if(function_exists('storyline_nav')) {
            $nav = storyline_nav()->getNavHTMLFromCourse($course);
            $styles = array_merge($styles, storyline_nav()->getStyles());
            $scripts = array_merge($scripts, storyline_nav()->getScripts());
            $custom_scripts[] = storyline_nav()->getCustomScripts();
        }

        $menu = '';
        if(function_exists('storyline_nav')) {
            $menu = storyline_menu()->getMenuHTMLFromCourse($course);
        }

        return view('lti.courses.lecture', ['data' => $data, 'course' => $course, 'nav' => $nav, 'styles' => $styles, 'scripts' => $scripts, 'custom_scripts' => $custom_scripts, 'custom_styles' => $custom_styles, 'menu' => $menu, 'course' => $course, 'storyline' => $storyline, 'storyline_item' => $storylineItem]);
    }

}
