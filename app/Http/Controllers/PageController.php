<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $pages = Page::with('categories')->get();
        return view('page.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('page.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $page = new Page;
        $page->name = $request->input('name');
        $page->description = $request->input('description');
        $page->sequance = $request->input('sequance');
        $page->published = $request->input('published') ? true : false;
        $page->save();
        if ($request->input('categories')) {
            $category = Category::whereIn('id',$request->input('categories'))->get();
            $page->categories()->attach($category);
        }
        return Redirect::to('page');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page = Page::with('comments')->find($id);
        return view('page.show',compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = Page::find($id);
        $categories = Category::all();
        return view('page.edite',compact(['page','categories']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $page = Page::find($id);
        $page->name = $request->input('name');
        $page->description = $request->input('description');
        $page->sequance = $request->input('sequance');
        $page->published = $request->input('published') ? true : false;
        $page->save();
        if ($request->input('categories')) {
            $category = Category::whereIn('id',$request->input('categories'))->get();
            $page->categories()->sync($category);
        }
        return Redirect::to('page');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = Page::find($id);
        $page->delete();
        return back();
    }
}
