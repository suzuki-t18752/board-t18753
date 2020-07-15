@extends('layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col col-md-offset-3 col-md-6">
        <nav class="panel panel-default">
          <div class="panel-heading">投稿の編集</div>
          <div class="panel-body">
            @if($errors->any())
              <div class="alert alert-danger">
                @foreach($errors->all() as $message)
                  <p>{{ $message }}</p>
                @endforeach
              </div>
            @endif
            <form action="{{ route('article.edit', ['article_id' => $article->id])}}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <label for="title">タイトル</label>
                <input type="text" class="form-control" name="title" id="title" value="{{ old('title') ?? $article->title  }}" />
              </div>
              <div class="form-group">
                <label for="article">本文</label>
                <textarea class="form-control" name="article" id="article">{{ old('article') ?? $article->article }}</textarea>
              </div>
              <div class="form-group">
                <label for="image">画像</label>
                <input type="file" name="image" id="image"/>
              </div>
              <div class="form-group">
                <select name="status" class="form-control">
                  <option value="0">公開</option>
                  <option value="1">非公開</option>
                </select>
              </div>
              <div class="text-right">
                <button type="submit" class="btn btn-primary">送信</button>
              </div>
              <a href="{{ route('article.show', ['article_id' => $article->id]) }}" class="btn">戻る</a>
            </form>
          </div>
        </nav>
      </div>
    </div>
  </div>
@endsection