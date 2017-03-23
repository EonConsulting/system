<?php

namespace App\Http\Controllers\Courses;

use App\Models\Course;
use App\Models\StorylineItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CourseContentController extends Controller {

    public function index(Course $course) {
        $storyline = $course->latest_storyline();
        $items = $storyline->items;
        return view('lecturer.courses.content', ['course' => $course, 'items' => $items, 'storyline' => $storyline]);
    }

    public function show(Course $course, StorylineItem $storylineItem) {
        $html = file_get_contents(public_path($storylineItem->file_url));
        return view('lecturer.courses.edit', ['course' => $course, 'item' => $storylineItem, 'html' => $html]);
    }

    public function update(Request $request, Course $course, StorylineItem $storylineItem) {

        $page = $storylineItem->file_url;

        $ext = pathinfo($page, PATHINFO_EXTENSION);
        $file_name = pathinfo($page, PATHINFO_FILENAME) . '-' . time() . '.' . $ext;

        if(!copy(public_path($page), public_path($file_name))) {
            session()->flash('error_message', 'Page could not save.');
            return response()->back();
        }

        $file = fopen(public_path($page), "w");
        fwrite($file, json_decode($request->get('data')));
        fclose($file);

        session()->flash('success_message', 'Page updated.');
        return redirect()->route('courses.single.content', [$course->id, $storylineItem->id]);
    }

}
