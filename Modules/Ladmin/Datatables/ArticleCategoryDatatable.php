<?php

namespace Modules\Ladmin\Datatables;

use App\Models\Model;
use Hexters\Ladmin\Datatables;
use Illuminate\Support\Facades\Blade;
use Modules\Ladmin\Models\ArticleCategory;

class ArticleCategoryDatatable extends Datatables
{

    /**
     * Page title
     *
     * @var String
     */
    protected $title = 'List of Article Category'; // Variable $title ini dapat di panggil pada VIEW

    /**
     * Setup query builder
     */
    public function __construct()
    {
        $this->query = ArticleCategory::query(); // Panggil MODEL yg ingin digunakan
    }

    /**
     * DataTables using Eloquent Builder.
     *
     * @return DataTableAbstract|EloquentDataTable
     */
    public function handle()
    {
        return $this->eloquent($this->query) // panggil $this->query di function handle
            ->addColumn('action', function ($row) { // addColumn untuk mengedit data sesuai dengan nama pada function column | $row itu berisi data dari model ArticleCategory, nama variable bebas
                return Blade::render('<a href="'.route('ladmin.article-category.show', $row->ulid).'" class="btn btn-primary">Details</a>'); // Untuk membuat sebuah button pada column action
            });
    }

    /**
     * Table headers
     *
     * @return array
     */
    public function headers(): array
    {
        // Ini adalah THEAD atau header dari Table yang akan ditampilkan, jumlah headers harus sama dengan jumlah  columns
        return [
            'Id',
            'Name',
            'State',
            'Action' => ['class' => 'text-center'],
        ];
    }

    /**
     * Datatables Data column
     * Visit Doc: https://datatables.net/reference/option/columns.data#Default
     *
     * @return array
     */
    public function columns(): array
    {
        // Ini adalah TBODY atau Data dari Table yang akan ditampilkan, jumlah columns harus sama dengan jumlah headers

        return [
            ['data' => 'id', 'class' => 'text-center'], // untuk isi dari parameter data sesuai dengan nama column dari table
            ['data' => 'name', 'class' => 'text-center'],
            ['data' => 'state', 'class' => 'text-center'],
            ['data' => 'action', 'class' => 'text-center', 'orderable' => false] // karena tidak ada nama column action pada table, maka perlu di edit pada function handle()
        ];
    }
}
