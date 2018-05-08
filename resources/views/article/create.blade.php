@extends('layout')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h1>ブログ新規追加</h1>

    <form method="post" action="/create" enctype="multipart/form-data">
      {{ csrf_field() }}
      <div class="form-group">
        <label for="titleInput">タイトル</label>
        <input type="text" class="form-control" id="titleInput" name="title" value="{{ old('title') }}">
        @if ($errors->has('title'))
            <span class="text-danger">{{ $errors->first('title') }}</span>
        @endif
      </div>
      <div class="form-group">
        <label for="bodyInput">内容</label>
        <textarea class="form-control" id="bodyInput" rows="3" name="body">{{ old('body') }}</textarea>
        @if ($errors->has('body'))
            <span class="text-danger">{{ $errors->first('body') }}</span>
        @endif
      </div>
	  <div class="form-group">
		<label>ファイル</label>
		<input type="file" name="attachment" class="form-control">
	  </div>
      <button type="submit" class="btn btn-primary">新規追加</button>
    </form>

@endsection
