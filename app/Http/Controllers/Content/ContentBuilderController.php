<?php

namespace App\Http\Controllers\Content;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContentBuilderController extends Controller {

    public function index() {
        return view('lecturer.builders.page');
    }

    public function store(Request $request) {
        dd($request->all());
    }

}
