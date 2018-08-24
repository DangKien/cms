<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\NewModel;

class CategoryController extends Controller
{
	private $categoryModel, $newModel;

	public function __construct(Category $categoryModel, NewModel $newModel) {
		$this->categoryModel = $categoryModel;
		$this->newModel      = $newModel;
	}

    public function detail($id, $slug, Request $request) {
    	$paginate = 10;
    	$page = $request->input('page', 1);
    	$listCategory = $this->categoryModel::with(['news' => function ($query)  {
						$query->select('news.id', 'title', 'view', 'vote', 'status', 'tag', 'hot', 'prioritize', 'description', 'url_image', 'created_at')
							->join('new_translation as t', 't.new_id', '=', 'news.id')
							->with('translations')
							->orderBy('prioritize', 'desc')
							->orderBy('hot', 'desc')
							->orderBy('id', 'desc')
			            	->with('user_creates')
			            	->get();
			            }])->findOrFail($id);

    	$slice = array_slice($listCategory->news->toArray(), $paginate * ($page - 1), $paginate);

    	$listNews = new \Illuminate\Pagination\LengthAwarePaginator($slice, count($listCategory->news), $paginate);
    	return view('Frontend.Contents.category.index', array('listCategory' => $listNews));
    }
}
