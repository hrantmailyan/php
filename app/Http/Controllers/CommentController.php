<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request) {
        // dd($request->all());
        $comment = new Comment;
        $comment->text = $request->text;
        $comment->parent_id = $request->parent_id;
        $comment->user_id = $request->user_id;
        $comment->page_id = $request->page_id;
        $comment->save();
        $comments = Comment::with('user')->where('page_id',$request->page_id)->where('parent_id',0)->get();
        
        return response()->json(['comment' => $comments]);
    }
    public function getChilde($id) {
        // dd($id);
        $comments = Comment::where('parent_id', $id)->with('child_comments')->with('user')->get();
        return response()->json(['comments'=> $comments]);
    }
}
