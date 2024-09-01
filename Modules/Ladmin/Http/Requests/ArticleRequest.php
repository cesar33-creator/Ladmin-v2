<?php

namespace Modules\Ladmin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;
use Modules\Ladmin\Models\Article;
use Illuminate\Support\Str;

class ArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'category_id' => ['required'],
            'article' => ['required', 'string', 'max:100'],
            'state' => ['required'],

        ];
    }

    public function createArticle()
    {
        $article = Article::create([
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'article' => $this->article,
            'category_id' => $this->category_id,
            'state' => $this->state
        ]);

        if($this->has('img_cover') && !is_null($this->img_cover)){
            $img = $this->uploadCover($article->ulid, $this->img_cover);
            $article->update([
                'img_url' => $img
            ]);
        }

        session()->flash('success', 'Artikel berhasil dibuat');
        return redirect()->route('ladmin.article.show', $article->ulid);
    }

    public function updateArticle($article)
    {
        $img = $article->img_url;
        if($this->file('img_cover')){
            $img = $this->uploadCover($article->ulid, $this->img_cover);
        }
        $article->update([
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'article' => $this->article,
            'category_id' => $this->category_id,
            'img_url' => $img,
            'state' => $this->state
        ]);

        session()->flash('success', 'Artikel berhasil diupdate');
        return redirect()->back();
    }

    private function uploadCover($ulid, $photo)
    {
        $path = $this->generateFolder($ulid);

        $photoPath = 'article/' . $ulid;

        $imgPath = Storage::disk('public')->put($photoPath, $photo);
        $url = env('APP_URL') . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . $imgPath;
        $return = $url;
        return $return;
    }

    private function generateFolder($ulid)
    {
        $path = storage_path('app/public/article');
        $resPath = $path . DIRECTORY_SEPARATOR . $ulid;

        if (!is_dir($path)) {
            mkdir($path);
        }

        if (!is_dir($resPath)) {
            mkdir($resPath);
        }
    }
}
