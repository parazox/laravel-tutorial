<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;

class ArticleController extends Controller
{
    //
    public function index() {
        //$articles = Article::all();
        $articles = Article::paginate(5);
        return view('article.index', ['articles' => $articles]);
    }



	public function create() {
        return view('article.create');
    }

    public function store(Request $request) {
		$request->validate([
			'title' => 'required|max:5',
			'body' => 'required',
            'attachment' => 'image',
		],[
			'title.required' => 'タイトルを入力してください',
			'title.max' => 'タイトルを5文字以下で入力してください',
			'body.required' => '本文を入力してください',
            'attachment.image' => '画像ファイルを選択してください',
		]);
        $article = new Article;
        $article->title = $request->title;
        $article->body = $request->body;

        if ($request->file('attachment')) {
            $article->attachment = basename($request->attachment->store('public/attachment'));
        }
        $article->save();
        $request->session()->flash('message', '登録したでござる');

        return redirect('/articles/' . $article->id);
    }

	public function edit(Request $request, $id) {
        $article = Article::find($id);
        return view('article.edit', ['article' => $article]);
    }

    public function update(Request $request) {
        $request->validate([
			'title' => 'required|max:5',
			'body' => 'required',
            'attachment' => 'image',
		],[
			'title.required' => 'タイトルを入力してください',
			'title.max' => 'タイトルを5文字以下で入力してください',
			'body.required' => '本文を入力してください',
            'attachment.image' => '画像ファイルを選択してください',
		]);

        $article = Article::find($request->id);
        $article->title = $request->title;
        $article->body = $request->body;
        if ($request->file('attachment')) {
            $article->attachment = basename($request->attachment->store('public/attachment'));
        }
        $article->save();
        $request->session()->flash('message', '登録したでござる');

        return redirect('/articles/' . $article->id);
    }

	public function show(Request $request, $id) {
        $article = Article::find($id);
        return view('article.show', ['article' => $article]);
    }

    public function delete(Request $request) {
        Article::destroy($request->id);
        return view('article.delete');
    }
}
