<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateArticleRequest;
use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

use function PHPUnit\Framework\isNull;

class ArticleController extends Controller
{
    public function show(Article $article, $slug)
    {
        $Article = $article->firstWhere('slug', $slug);
        $User = User::firstWhere('token', Session::get('token'));
        if (!$Article) return view('error.error', ['data' => $slug, 'user' => $User]);
        $ArticleTitle = $Article->title;
        $Comment      = $Article->comments()->get();
        $Title  = Str::of("$ArticleTitle ~ Article-Zone")->title();
        return view('article', [
            'title'         => $Title,
            'article'       => $Article,
            'comments'      => $Comment,
            'author'        => $User->name,
            'user'          => $User
        ]);
    }

    public function index()
    {
        if (Session::has('token')) {
            $User     = User::firstWhere('token', Session::get('token'));
            $Articles = $User->articles()->orderBy('id', 'desc')->paginate(4);
            $Title    = 'Dashboard ~ Article-Zone';
            return view('dashboard', [
                'title'     => $Title,
                'articles'  => $Articles,
                'meta'      => [
                    'nextPage'      => $Articles->nextPageUrl(),
                    'currentPage'   => $Articles->currentPage(),
                    'prevPage'      => $Articles->previousPageUrl()
                ],
                'user'      => $User
            ]);
        } else {
            return redirect()->back();
        }
    }

    public function create(CreateArticleRequest $request)
    {
        $User = User::firstWhere('token', session()->get('token'));
        $created = Article::create([
            'title'         => $request->title,
            'users_id'       => $User->id,
            'slug'          => Str::of($request->title)->slug('-'),
            'description'   => $request->description,
            'tag'           => Str::of($request->tag)->lower()
        ]);

        if ($created) return to_route('dashboard')->with('message', 'Article Created.');
        return redirect()->back()->with('message', 'Article Created Failed.');
    }

    public function destroy(Article $article, $id)
    {
        $deleted = $article->find($id)->delete();
        if ($deleted) return to_route('dashboard')->with('message', 'Article Deleted');
        return redirect()->back()->with('message', 'Article Deleted Failed.');
    }

    public function editArticle($slug)
    {
        $Title   = 'Update Article ~ Article-Zone';
        $User    = User::firstWhere('token', session()->get('token'));
        $Article = Article::firstWhere('slug', $slug);
        return view('article-edit', [
            'title'     => $Title,
            'article'   => $Article,
            'user'      => $User
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title'         => ['required', 'string'],
            'description'   => ['required', 'string', 'min:10'],
            'tag'           => ['max:10', 'nullable']
        ]);

        $updated = Article::where('id', $id)->update([
            'title'         => $request->title,
            'slug'          => Str::of($request->title)->slug('-'),
            'description'   => $request->description,
            'tag'           => $request->tag
        ]);
        if ($updated)  return to_route('dashboard')->with('message', 'Article Updated.');
        return to_route('article.edit')->with('message', 'Article Updated Failed.');
    }

    public function detail_tag($tag)
    {
        $Tag   = Article::where('tag', $tag)->get();
        $User  = User::firstWhere('token', session()->get('token'));
        if (count($Tag) < 1)  return view('error.error', ['data' => $tag, 'user' => $User]);
        $Title = Str::of($tag)->ucfirst() . " ~ Article-Zone";
        return view('tag', [
            'user'  => $User,
            'title' => $Title,
            'tag'   => $tag,
            'item'  => $Tag
        ]);
    }

    public function posts_user($email)
    {
        $User          = User::firstWhere('token', Session::get('token'));
        $ArticlesUser   = User::firstWhere('email', $email);
        if (!$ArticlesUser)    return view('error.error', ['data' => $email, 'user' => $User]);
        $Title          = 'Posts By ' . Str::of($ArticlesUser->name)->ucfirst();
        $Articles       = $ArticlesUser->articles()->orderBy('id', 'desc')->paginate(4);
        return view('user-articles', [
            'title'         => $Title,
            'articles'      => $Articles,
            'userarticles'  => $ArticlesUser,
            'meta'     => [
                'nextPage'      => $Articles->nextPageUrl(),
                'prevPage'      => $Articles->previousPageUrl(),
                'currentPage'   => $Articles->currentPage()
            ],
            'user'           => $User
        ]);
    }
}
