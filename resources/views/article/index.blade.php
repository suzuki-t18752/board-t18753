@extends('layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col col-md-3">
        <nav class="panel panel-default">
          <div class="panel-heading">メニュー</div>
          <div class="panel-body">
            <div>
              <span>今月の　投稿数<strong>{{$count_article}}</strong></span>
              <span>/登録者数<strong>{{$count_user}}</strong></span>
            </div>
            <a href="/article/create" class="btn btn-default btn-block">新規投稿</a>
            <a href="{{ route('user.index', ['user_id' => Auth::id()]) }}" class="btn btn-default btn-block">投稿の管理</a>
            <a href="{{ route('user.edit', ['user_id' => Auth::id()]) }}" class="btn btn-default btn-block">ユーザー情報編集</a>
          </div>
        </nav>
      </div>
      <div class="column col-md-9">
        <div class="panel panel-default">
          <div class="panel-heading">投稿一覧</div>
          <table class="table">
            <thead>
              <tr>
                <th>タイトル</th>
                <th>投稿者</th>
                <th>投稿日時</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach($articles as $article)
                <tr>
                  <td>{{ $article->title }}</td>
                  <td>{{ $article->user->name }}</td>
                  <td>{{ $article->created_at }}</td>
                  <td><a href="{{ route('article.show', ['article_id' => $article->id]) }}">詳細</a></td>
                </tr>
              @endforeach
              <tr ><td colspan="4"> {{ $articles->links() }}</td></tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection