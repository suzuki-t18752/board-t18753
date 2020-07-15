<?php

namespace App\Http\Controllers;
use App\Article;
use App\User;
use App\Comment;
use App\Http\Requests\CreateArticle;
use App\Http\Requests\CreateComment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::all();
        $articles = Article::where('status', 0)->paginate(30);
        $day = Carbon::now('m');
        $count_article = Article::whereMonth('created_at', $day)->count();
        $count_user = User::whereMonth('created_at', $day)->count();
        
        return view('article/index', [
            'articles' => $articles,
            'count_article' => $count_article,
            'count_user' => $count_user,
        ]);
    }
    public function showCreateForm()
    {
        return view('article/create');
    }
    public function create(CreateArticle $request)
    {
        $article = new Article();
        $article->title = $request->title;
        $article->article = $request->article;
        $article->status = $request->status;
        $article->user_id = Auth::id();
        if(!($request->image)){
        }else{
            $path = $request->file('image')->store('public/image');
            $article->image = basename($path);
        }
        $article->save();
        return redirect('/article/show/' . $article->id);
    }

    public function show(int $article_id)
    {
        $article = Article::find($article_id);
        $query = Comment::query();
        $query->where('article_id', $article_id); 
        $query->where('status', 0);
        $comments = $query->paginate(30);
        return view('article.show', ['article' => $article, 'comments' => $comments,]);
    }

    public function articleEditForm(int $article_id)
    {
        $article = Article::find($article_id);
        $this->authorize('view', $article); 
        return view('article.edit', ['article' => $article]);
    }

    public function edit(int $article_id, CreateArticle $request)
    {
        $article = Article::find($article_id);
        $article->title = $request->title;
        $article->article = $request->article;
        $article->status = $request->status;
        if(!($request->image)){
        }else{
            $path = $request->file('image')->store('public/image');
            $article->image = basename($path);
        }
        $article->save();
        return redirect('/article/show/' . $article_id);
    }

    public function delete(int $article_id)
    {
        $article = Article::find($article_id);
        $article->delete();
        return redirect('/'); 
    }

    public function commentCreate(int $article_id, CreateComment $request)
    {
        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->article_id = $article_id;
        $comment->user_id = Auth::id();
        $comment->save();
        return redirect('/article/show/' . $article_id);
    }
    public function commentEditForm(int $comment_id)
    {
        $comment = Comment::find($comment_id);
        return view('article.comment_edit', ['comment' => $comment,]);
    }
    public function commentEdit(int $comment_id, CreateComment $request)
    {
        $comment = Comment::find($comment_id);
        $comment->comment = $request->comment;
        $comment->save();
        return redirect('/article/show/' . $comment->article_id);
    }

    public function commentDelete(int $article_id, int $comment_id)
    {
        $comment = Comment::find($comment_id);
        $comment->delete();
        return redirect('/article/show/' . $article_id);
    }

    public function returnComment(int $comment_id)
    {
        $comment = Comment::find($comment_id);
        $comments = Comment::all();
        $comments = Comment::where('status', $comment_id)->paginate(30);
        return view('article.return_comment', ['comment' => $comment, 'comments' => $comments,]);
    }

    public function returnCreate(int $comment_id, CreateComment $request)
    {
        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->article_id = $request->article_id;
        $comment->user_id = Auth::id();
        $comment->status = $comment_id;
        $comment->save();
        return redirect('/article/return_comment/' . $comment_id);
    }

    public function returnEditForm(int $comment_id)
    {
        $comment = Comment::find($comment_id);
        return view('article.return_edit', ['comment' => $comment,]);
    }
    public function returnEdit(int $comment_id, CreateComment $request)
    {
        $comment = Comment::find($comment_id);
        $comment->comment = $request->comment;
        $comment->save();
        return redirect('/article/return_comment/' . $comment->status);
    }

    public function returnDelete(int $comment_id, int $return_id)
    {
        $comment = Comment::find($return_id);
        $comment->delete();
        return redirect('/article/return_comment/' . $comment_id);
    }
}
