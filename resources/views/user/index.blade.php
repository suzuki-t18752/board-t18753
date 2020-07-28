@extends('layout')

@section('content')
  <div class="container">
    <div class="row">
    <div class="col col-md-3">
        <nav class="panel panel-default">
          <div class="panel-heading">メニュー</div>
          <div class="panel-body">
            <a href="/article/create" class="btn btn-default btn-block">新規投稿</a>
            <a href="{{ route('user.index', ['user_id' => Auth::id()]) }}" class="btn btn-default btn-block">投稿の管理</a>
            <a href="{{ route('user.edit', ['user_id' => Auth::id()]) }}" class="btn btn-default btn-block">ユーザー情報編集</a>
            <a href="/user/index/{{Auth::id()}}/export" class="btn btn-default btn-block">投稿のCSV出力</a>
          </div>
          <div class="list-group">
            
          </div>
        </nav>
      </div>
      <div class="column col-md-9">
        <div class="panel panel-default">
          <div class="panel-heading">投稿の管理</div>
          <table class="table">
            <thead>
            <tr>
              <th>タイトル</th>
              <th>投稿日時</th>
              <th colspan="3"></th>
            </tr>
            </thead>
            <tbody>
              @foreach($articles as $article)
                <tr>
                  <td>{{ $article->title }}</td>
                  <td>{{ $article->created_at }}</td>
                  <td><a href="{{ route('article.show', ['article_id' => $article->id]) }}">詳細</a></td>
                  <td><a href="{{ route('article.edit', ['article_id' => $article->id]) }}">編集</a></td>
                  <td><a href="/article/delete/{{$article->id}}" onclick="return delete_check()">削除</a></td>
                </tr>
              @endforeach
              <tr><td colspan="5"> {{ $articles->links() }}</td></tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection