@extends('layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col col-md-7">
        <nav class="panel panel-default">
          <div class="panel-heading">投稿の詳細</div>
          <div class="list-group">
            <table class="table">
              <tbody>
                <tr>
                  <td><strong>{{ $article->title }}</strong></td>
                  <td>{{ $article->user->name }}</td>
                  <td>{{ $article->created_at }}</td>
                  @if(($article->user_id) === Auth::id())
                    <td><span class='label $article->status_class'>{{$article->status_label}}</span></td>
                    <td><a href="{{ route('article.edit', ['article_id' => $article->id]) }}">編集</a></td>
                    <td><a href="/article/delete/{{$article->id}}" onclick="return delete_check()">削除</a></td>
                  @endif
                </tr>
                <tr><td colspan="6">{{ $article->article }}</td></tr>
                @if(!($article->image === null))
                  <tr><td><img src="{{ asset('storage/image/' . $article->image) }}" id="image_size"></td></tr>
                @endif
              </tbody>
            </table>
          </div>
        </nav>
      </div>
      <div class="col col-md-5">
        <nav class="panel panel-default">
          <div class="panel-heading">コメント</div>
          <div class="panel-body">
            @if($errors->any())
                <div class="alert alert-danger">
                  @foreach($errors->all() as $message)
                    <p>{{ $message }}</p>
                  @endforeach
                </div>
            @endif
            <form action="{{ route('article.show', ['article_id' => $article->id])}}" method="POST">
              @csrf
              <div class="form-group">
                <input type="text" class="form-control" name="comment" id="comment" value="{{ old('comment') }}" />
              </div>
              <div class="text-right">
                <button type="submit" class="btn btn-primary" onclick="return comment_check()">コメント</button>
              </div>
            </form>
          </div>
          <ul class="list-group">
            @foreach($comments as $comment)
              <li class="list-group-item">
                <span>{{ $comment->comment }}</span>
                <br>
                <span>{{ $comment->user->name }}</span>
                <span><a href="{{ route('article.return_comment', ['commenrt_id' => $comment->id])}}">コメントへの返信</a></span>
                @if($comment->user_id === Auth::id())
                  <span><a href="{{ route('article.comment_edit', ['commenrt_id' => $comment->id])}}">編集</a></span>
                  <span><a href="/article/show/{{$article->id}}/{{$comment->id}}" onclick="return delete_check()">削除</a></span>
                @endif
              </li>
            @endforeach
            <li class="list-group-item">{{ $comments->links() }}</li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
@endsection