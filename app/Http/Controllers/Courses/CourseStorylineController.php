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

        session()->flash('success_message', 'Storyline saved.');
        return redirect()->route('courses.single.storyline', $course->id);

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

    public function get(Course $course) {
        $storyline = $course->latest_storyline();
        $items = $storyline->items;

        $tree = $this->get_storyline($items->toArray());

        return ['course' => $course, 'storyline' => $storyline, 'items' => $items, 'parts' => $tree];
    }

    private function get_storyline(array $elements, $parentId = false) {
        $branch = array();

        foreach ($elements as $element) {
            if ($element['parent_id'] == $parentId) {
                $children = $this->get_storyline($elements, $element['id']);
                if ($children) {
                    $element['children'] = $children;
                }

                if(array_key_exists('file_name', $element) && !is_null($element['file_name']) && array_key_exists('file_url', $element) && !is_null($element['file_url'])) {
                    $element['files'] = [
                        ['name' => $element['file_name'], 'url' => $element['file_url']]
                    ];
                }
                $branch[] = $element;
            }
        }

        return $branch;
    }

}
