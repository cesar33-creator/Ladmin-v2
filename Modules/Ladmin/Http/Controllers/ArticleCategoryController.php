<?php

namespace Modules\Ladmin\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Ladmin\Datatables\ArticleCategoryDatatable;
use Modules\Ladmin\Models\ArticleCategory;

class ArticleCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // return 'ada';
        return ArticleCategoryDatatable::view('ladmin::article_category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('ladmin::article_category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $category = ArticleCategory::create([ // Buat sebuah variable baru dengan memanggil Model ArticleCategory kemudian tambahkan function create
            'name' => $request->category_name, // 'name' adalah nama column pada model / table ArticleCategory, $request->category_name adalah data yang panggil berdasarkan yang diinput dihalaman create
            'state' => 'active'
        ]);

        session()->flash('success', 'Data category berhasil dibuat'); // fungsinya menambahkan alert, parameter ke-1 adalah tipe alert nya seperti (success, danger, info, warning), parameter ke-2 untuk Pesan dari alert nya
        return redirect()->route('ladmin.article-category.show', $category->ulid); // Jika semua sudah selesai maka return untuk pindah kehalaman lain yaitu detail dari category dengan cara menambahkan route dan $category->ulid
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $data['category'] = ArticleCategory::whereUlid($id)->firstOrFail(); // Buat sebuah variable baru untuk memanggil Model ArticleCategory kemudian cari data yang dimana ULID nya adalah $ulid, jika ada lanjut dan jika tidak ada maka akan menampilkan error 404
        return view('ladmin::article_category.show', $data); //Return ke sebuah VIEW detail category dengan parameternya ialah $data, supaya variable $category bisa dipanggil pada View
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $data['category'] = ArticleCategory::whereUlid($id)->firstOrFail(); // Buat sebuah variable baru untuk memanggil Model ArticleCategory kemudian cari data yang dimana ULID nya adalah $ulid, jika ada lanjut dan jika tidak ada maka akan menampilkan error 404
        return view('ladmin::article_category.edit', $data); //Return ke sebuah VIEW edit category dengan parameternya ialah $data, supaya variable $category bisa dipanggil pada View
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $category = ArticleCategory::whereUlid($id)->firstOrFail(); // Buat sebuah variable baru untuk memanggil Model ArticleCategory kemudian cari data yang dimana ULID nya adalah $ulid, jika ada lanjut dan jika tidak ada maka akan menampilkan error 404
        $category->update([ // update data seperti create data
            'name' => $request->category_name,
        ]);

        session()->flash('success', 'Data category berhasil diedit'); // fungsinya menambahkan alert, parameter ke-1 adalah tipe alert nya seperti (success, danger, info, warning), parameter ke-2 untuk Pesan dari alert nya
        return redirect()->route('ladmin.article-category.index', $category->ulid); // Jika semua sudah selesai maka return untuk pindah kehalaman lain yaitu detail dari category dengan cara menambahkan route dan $category->ulid
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $category = ArticleCategory::whereUlid($id)->firstOrFail(); // Buat sebuah variable baru untuk memanggil Model ArticleCategory kemudian cari data yang dimana ULID nya adalah $ulid, jika ada lanjut dan jika tidak ada maka akan menampilkan error 404
        $category->delete(); //untuk menghapus Data berdasarkan ulid yg dipilih

        session()->flash('success', 'Data category berhasil dihapus'); // fungsinya menambahkan alert, parameter ke-1 adalah tipe alert nya seperti (success, danger, info, warning), parameter ke-2 untuk Pesan dari alert nya
        return redirect()->route('ladmin.article-category.index'); // Jika semua sudah selesai maka return untuk pindah kehalaman lain yaitu detail dari category dengan cara menambahkan route sesuai yg diinginkan
    }
}
