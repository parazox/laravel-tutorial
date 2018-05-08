@extends('layout')

@section('content')

    <h1>ブログ削除</h1>

    <form method="post" action="/delete">
      {{ csrf_field() }}
      <input type="hidden" class="form-control" name="id" value="{{ $article->id }}">
      <div class="form-group">
        <label for="titleInput">タイトル</label>
        {{ $article->title }}
      </div>
      <div class="form-group">
        <label for="bodyInput">内容</label>
        {!! nl2br(e($article->body)) !!}
      </div>

      @if ($article->attachment)
        <label>画像</label>
        <div><img src="/storage/attachment/{{ $article->attachment }}" width="200"></div>
      @endif
      <button type="submit" class="btn btn-primary">削除</button>
    </form>

    <a href="/edit/{{ $article->id }}">編集</a>


    <h2>コメント</h2>
    <form method="post" action="/comments">
      {{ csrf_field() }}
    <input type="hidden" class="form-control" name="article_id" value="{{ $article->id }}">
      <div class="form-group">
        <label for="bodyInput">内容</label>
        <textarea class="form-control" id="commentInput" rows="3" name="comment">{{ old('comment') }}</textarea>
      </div>
      <button type="submit" class="btn btn-primary">コメント</button>
      @if ($errors->has('comment'))
          <span class="text-danger">{{ $errors->first('comment') }}</span>
      @endif
    </form>

    @foreach ($article->comments as $comment)
        <div>{{ $comment->comment }}</div>
    @endforeach
@endsection
