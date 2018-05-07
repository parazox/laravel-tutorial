<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
    //
    public function store(Request $request) {
        $request->validate([
			'comment' => 'required|max:5',
		],[
			'comment.required' => 'コメントを入力してください',
			'comment.max' => 'コメントを5文字以下で入力してください',
		]);
        $request->session()->flash('message', '登録したでござる');

        $comment = new Comment;
        $comment->comment = $request->comment;
        $comment->article_id = $request->article_id;
        $comment->save();
        return redirect('/articles/' . $request->article_id);
    }
}
