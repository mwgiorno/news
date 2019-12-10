<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateCommentRequest;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Comment;
use App\News;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function leaveComment(CreateCommentRequest $request, News $news)
    {
        Comment::new(
            Auth::id(),
            $news->id,
            $request->body
        );
        return view('news.comment', ['comments' => $news->comments]);
    }

    public function reply(CreateCommentRequest $request, Comment $comment)
    {
        Comment::reply(
            Auth::id(),
            $comment->news->id,
            $comment->id,
            $request->body
        );

        return back();
    }

    public function update(News $news)
    {
        return View::make('news.comment', compact('news'));
    }
}
