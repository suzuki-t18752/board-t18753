<?php

namespace App\Http\Controllers;
use App\User;
use App\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\StreamedResponse;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $articles = Article::all();
        if($request->title_search == null){
            $articles = Article::where('user_id', Auth::id())->paginate(30);
        }else{
            $title = $request->title_search;
            $articles = Article::where([
                ['user_id', Auth::id()],
                ['title', 'LIKE', '%'.$title.'%'],
            ])->paginate(30);
        }

        return view('user/index', [
            'articles' => $articles,
        ]);
    }

    public function userEditForm(int $user_id)
    {
        $user = User::find($user_id);
        $this->authorize('view', $user); 
        return view('user/edit', [
            'user' => $user,
        ]);
    }

    public function edit(int $user_id, Request $request)
    {
        $user = User::find($user_id);
        $user->name = $request->name;
        $user->email = $request->email;
        if(!($request->password)){
            $user->password = Auth::user()->password;
        }else{
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->route('article.index');
    }

    public function articleExport(int $user_id)
    {
        return  new StreamedResponse(
            function () {
                $stream = fopen('php://output', 'w');
                Article::chunk(100, function ($articles) use ($stream) {
                    foreach ($articles as $article) {
                        fputcsv($stream, [$article->title, $article->article, $article->image, $article->created_at, $article->update_at]);
                    }
                });
                fclose($stream);
            },
            200,
            [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="article.csv"',
            ]
        );

        return redirect('/user/index/' . $user_id);
    }
}
