<?php

namespace Modules\Ladmin\Datatables;

use App\Models\Model;
use Hexters\Ladmin\Datatables;
use Illuminate\Support\Facades\Blade;
use Modules\Ladmin\Models\Article;

class ArticleDatatable extends Datatables
{

    /**
     * Page title
     *
     * @var String
     */
    protected $title = 'List of Articles';

    /**
     * Setup query builder
     */
    public function __construct()
    {
        $this->query = Article::with(['category']);
    }

    /**
     * DataTables using Eloquent Builder.
     *
     * @return DataTableAbstract|EloquentDataTable
     */
    public function handle()
    {
        return $this->eloquent($this->query)
            ->addColumn('cover', function($row){
                return Blade::render('<img src="'.$row->img_url.'" width=75>');
            })
            ->addColumn('action', function ($row) {

                return $this->actions($row);
                // return Blade::render('<a href="'.route('ladmin.article.show', $row->ulid).'" class="btn btn-primary">Details</a>');
            });
    }

    public function actions($row)
    {
        $data['row'] = $row;
        return view('ladmin::article._parts._action', $data);
    }

    /**
     * Table headers
     *
     * @return array
     */
    public function headers(): array
    {
        return [
            '#',
            'Title',
            'Category',
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
        return [
            ['data' => 'cover', 'class' => 'text-center'],
            ['data' => 'name', 'class' => 'text-center'],
            ['data' => 'category.name', 'class' => 'text-center'],
            ['data' => 'state', 'class' => 'text-center'],
            ['data' => 'action', 'class' => 'text-center', 'orderable' => false]
        ];
    }
}
