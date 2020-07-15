@extends('layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col col-md-12">
        <nav class="panel panel-default">
          <div class="list-group">
            <table class="table">
              <tbody>
                <tr>
                  <td>
                    <a href="{{ route('article.show', ['article_id' => $comment->article_id]) }}" class="btn">投稿へ戻る</a>
                  </td>
                </tr>
                <tr>
                  <td>{{ $comment->comment }}</td>
                  <td>{{ $comment->user->name }}</td>
                  <td>{{ $comment->created_at }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </nav>
      </div>
      <div class="col col-md-12">
        <nav class="panel panel-default">
          <div class="panel-heading">コメントへの返信</div>
          <div class="panel-body">
            @if($errors->any())
                <div class="alert alert-danger">
                  @foreach($errors->all() as $message)
                    <p>{{ $message }}</p>
                  @endforeach
                </div>
            @endif
            <form action="{{ route('article.return_comment', ['comment_id' => $comment->id])}}" method="POST">
              @csrf
              <div class="form-group">
                <input type="text" class="form-control" name="comment" id="comment" value="{{ old('comment') }}" />
                <input type="hidden" class="form-control" name="article_id" id="article_id" value="{{ $comment->article_id }}" />
              </div>
              <div class="text-right">
                <button type="submit" class="btn btn-primary" onclick="return comment_check()">返信</button>
              </div>
            </form>
          </div>
          <ul class="list-group">
            @foreach($comments as $return)
              <li class="list-group-item">
                <span>{{ $return->comment }}</span>
                <br>
                <span>{{ $return->user->name }}</span>
                @if($return->user_id === Auth::id())
                  <span><a href="{{ route('article.return_edit', ['commenrt_id' => $return->id])}}">編集</a></span>
                  <span><a href="/article/return_comment/{{$comment->id}}/delete/{{$return->id}}" onclick="return delete_check()">削除</a></span>
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