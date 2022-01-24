<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function welcome() {
        $pages = Page::with('categories')->get();
        return view('welcome', compact('pages'));
    }
    public function show_page($id) {
        $page = Page::with('comments')->find($id);
        return view('page.show',compact('page'));
    }
}
