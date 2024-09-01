<?php

namespace Modules\Ladmin\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Ladmin\Datatables\ArticleDatatable;
use Modules\Ladmin\Http\Requests\ArticleRequest;
use Modules\Ladmin\Models\Article;
use Modules\Ladmin\Models\ArticleCategory;
use Modules\Ladmin\Models\Book;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        ladmin()->allows('ladmin.article.index');

        return ArticleDatatable::view('ladmin::article.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        ladmin()->allows('article.create');

        $data['article'] = new Article;
        $data['category'] = ArticleCategory::where('state', 'active')->get();
        return view('ladmin::article.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleRequest $request)
    {
        ladmin()->allows('article.create');

        return $request->createArticle();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $ulid)
    {
        ladmin()->allows('article.show');

        $data['article'] = Article::whereUlid($ulid)->firstOrFail();
        return view('ladmin::article.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $ulid)
    {
        ladmin()->allows('article.update');

        $data['article'] = Article::whereUlid($ulid)->firstOrFail();
        $data['category'] = ArticleCategory::where('state', 'active')->get();
        return view('ladmin::article.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleRequest $request, string $ulid)
    {
        ladmin()->allows('article.update');

        $article = Article::whereUlid($ulid)->firstOrFail();

        return $request->updateArticle($article);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $ulid)
    {
        ladmin()->allows('article.destroy');

        $article = Article::whereUlid($ulid)->firstOrFail();

        $this->deletePicture($article);
        $article->delete();

        // return redirect()->route();
        return to_route('ladmin.article-category.index')->with('success', ['Artikel berhasil dihapus']);
    }



    private function deletePicture($article)
    {
        if ($article->img_url) {
            $basename_thumbnail = basename($article->img_url);
            $file = storage_path('app/public/article/' . $article->ulid . DIRECTORY_SEPARATOR . $basename_thumbnail);

            if (file_exists($file)) {
                unlink($file);
            }
        }
    }
}
