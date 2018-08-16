<?php

namespace App\Libs\Providers\Frontend;

use App\Models\Menu as MenuModel;
use App\Libs\Configs\StatusConfig;
use App\Models\NewModel;
use App\Models\Category;
use App, DB;

class News {

	private $menuModel, $newModel, $cateogryModel;

	public function __construct()
	{
		$this->menuModel     = new MenuModel();
		$this->newModel      = new NewModel();
		$this->cateogryModel = new Category();
	}

	public function getNewCategory($categoryId, $limit) {

		$news = $this->cateogryModel::with(['news' => function ($query) use ($limit)  {
			$query->select('news.id', 'title', 'view', 'vote', 'status', 'tag', 'hot', 'prioritize', 'description', 'url_image', 'created_at')
				->join('new_translation as t', 't.new_id', '=', 'news.id')
				->with('translations')
				->orderBy('prioritize', 'desc')
				->orderBy('hot', 'desc')
				->orderBy('id', 'desc')
            	->with('user_creates')
            	->with('categories')
            	->limit($limit)
            	->get();
		} ])->findOrFail($categoryId);
		return $news;
	}

}



    
