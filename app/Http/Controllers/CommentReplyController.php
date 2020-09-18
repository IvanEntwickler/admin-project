<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentReplyController extends Controller
{
    //
    public function index(){
        return view('admin.comments.replies.index');
    }
}
