<?php

namespace App\Http\Controllers\API;

use App\Models\Article;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\ArticleRequest;
use App\Http\Requests\API\UpdateArticleRequest;
use App\Http\Resources\ArticleResource;
use Illuminate\Support\Str;


class ArticleAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::all();
        return  ArticleResource::collection($articles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        $request->validated();

        $created = Article::create([
            'title'         => $request->title,
            'slug'          => Str::slug($request->title, '-'),
            'description'   => $request->description,
            'tag'           => Str::lower($request->tag)
        ]);

        if ($created) {
            return response()->json([
                'status'    => true,
                'message'   => 'Article Created successfully.'
            ], 201);
        }
        return response()->json([
            'status'    => false,
            'message'   => 'Article Created failed.'
        ], 401);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::find($id);
        if (!$article) {
            return response()->json([
                'status'    => false,
                'message'   => 'Article could not be found.'
            ], 400);
        }
        return new ArticleResource(Article::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateArticleRequest $request, Article $article, $id)
    {
        $data = $article->find($id);
        if (!$data) return response()->json(['status' => false, 'message'   => 'Article could not be found.'], 400);
        $request->validated();
        $updated = $article->find($id)->update($request->all());
        if ($updated) {
            if ($request->title) {
                $data->slug = Str::of($request->title)->slug('-');
                $data->save();
            }
            return response()->json([
                'status'    => true,
                'message'   => 'Article Updated succesfully.'
            ], 200);
        }
        return response()->json([
            'status'    => false,
            'message'   => 'Article Updated failed.'
        ], 401);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        if (!$article) return response()->json(['status' => false, 'message'   => 'Article could not be found.'], 400);
        $deleted = $article->delete();
        if ($deleted) {
            return response()->json([
                'status'    => true,
                'message'   => 'Article Deleted successfully.'
            ], 200);
        }

        return response()->json([
            'status'    => false,
            'message'   => 'Article Deleted failed.'
        ], 401);
    }

    public function search_tag($tag)
    {
        $tagArticles = Article::where('tag', 'like', '%' . $tag . '%')->get();
        if ($tagArticles->count() === 0) return response()->json(['status' => false, 'message'   => 'Tag could not be found.'], 400);
        return  ArticleResource::collection($tagArticles);
    }
    public function search_title($title)
    {
        $titleArticles = Article::where('title', 'like', '%' . $title . '%')->get();
        if ($titleArticles->count() === 0) return response()->json(['status' => false, 'message'   => 'Title could not be found.'], 400);
        return  ArticleResource::collection($titleArticles);
    }
}
