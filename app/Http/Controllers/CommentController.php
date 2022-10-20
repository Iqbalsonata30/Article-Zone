<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CommentController extends Controller
{
    public function inputComment(Request $request, $slug)
    {
        $request->validate([
            'comment'   => ['required']
        ]);
        $Article = Article::firstWhere('slug', $slug);
        $User = User::firstWhere('token', Session::get('token'));
        Comment::create([
            'users_id'      => $User->id,
            'articles_id'   => $Article->id,
            'comment'       => $request->comment,
        ]);
        return redirect()->back()->with('message', 'Comment Added.');
    }

    public function deleteComment(Comment $comment, $id)
    {
        $comments = $comment->find($id)->delete();
        if ($comments) return redirect()->back()->with('message', 'Comment Deleted.');
        return redirect()->back()->with('message', 'Comment Deleted failed.');
    }
}
