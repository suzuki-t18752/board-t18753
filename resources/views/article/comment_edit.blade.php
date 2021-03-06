@extends('layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col col-md-offset-3 col-md-6">
        <nav class="panel panel-default">
          <div class="panel-heading">コメントの編集</div>
          <div class="panel-body">
            @if($errors->any())
              <div class="alert alert-danger">
                @foreach($errors->all() as $message)
                  <p>{{ $message }}</p>
                @endforeach
              </div>
            @endif
            <form action="{{ route('article.comment_edit', ['comment_id' => $comment->id])}}" method="POST">
              @csrf
              <div class="form-group">
                <input type="text" class="form-control" name="comment" id="comment" value="{{ old('comment') ?? $comment->comment }}" />
              </div>
              <div class="text-right">
                <button type="submit" class="btn btn-primary" onclick="return comment_check()">コメント</button>
              </div>
            </form>
            <a href="{{ route('article.show', ['article_id' => $comment->article_id]) }}" class="btn">投稿へ戻る</a>
          </div>
        </nav>
      </div>
    </div>
  </div>
@endsection