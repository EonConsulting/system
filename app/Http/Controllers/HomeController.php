<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // check if user has any roles, if not
//        return view('landing.todo');

        // else
        if (laravel_lti()->is_learner(auth()->user())) {
            return view('lti.dashboards.student');
        }
        //Return Default
        return view('admin.dashboards.dashboard');
    }
}
