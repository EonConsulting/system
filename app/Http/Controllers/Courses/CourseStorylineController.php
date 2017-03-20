<?php

namespace App\Http\Controllers\Courses;

use App\Models\Course;
use App\Models\Storyline;
use App\Models\StorylineItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CourseStorylineController extends Controller {

    public function index(Course $course) {
        return view('lecturer.storylines.single', ['course' => $course]);
    }

    public function store(Request $request, Course $course) {
        $parts = $request->all()['parts'];

        $storyline = new Storyline;
        $storyline->course_id = $course->id;
        $storyline->creator_id = $request->user()->id;
        $storyline->save();

        $data = json_decode($parts);
        for($i = 0; $i < count($data); $i++) {
            $this->save_storyline($storyline, $data[$i]);
        }

    }

    private function save_storyline($storyline, $data, $parent = false) {
        $item = new StorylineItem;
        $item->storyline_id = $storyline->id;
        $item->name = $data->name;
        $item->type = $data->type;
        $item->parent_id = ($parent) ? $parent->id : null;

        $item->save();

        if(isset($data->files)) {
            for($i = 0; $i < count($data->files); $i++) {
                $item->file_name = $data->files[$i]->name;
                $item->file_url = $data->files[$i]->url;
            }
        }

        if(isset($data->children)) {
            for($i = 0; $i < count($data->children); $i++) {
                $this->save_storyline($storyline, $data->children[$i], $item);
            }
        }

        $item->save();
    }

}
