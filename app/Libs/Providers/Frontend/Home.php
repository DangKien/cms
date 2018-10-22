<?php

namespace App\Libs\Providers\Frontend;

use App\Models\Menu as MenuModel;
use App\Libs\Configs\StatusConfig;
use App\Models\NewModel;
use App\Models\Category as CategoryModel ;
use App\Models\Flipbook;
use App, DB;

class Home {

	private $menuModel, $newModel;

	public function __construct()
	{
		$this->menuModel     = new MenuModel();
		$this->newModel      = new NewModel();
		$this->categoryModel = new CategoryModel();
		$this->magazineModel = new Flipbook();
	}

	public function getHotNew($limit) {

        //lay danh sach tin binh thuong
		$news_prioritize = $this->newModel->select(DB::raw('0 as level') ,'news.id', 'title', 'view', 'vote', 'status', 'tag', 'hot', 'prioritize', 'description', 'url_image', 'created_at')
		                    	->join('new_translation as t', 't.new_id', '=', 'news.id')
		                   	 	->where( array(
		                   	 		array('status', StatusConfig::CONST_AVAILABLE),
									array('locale', App::getLocale()),
									array('prioritize', 0),
								))
		                    	->with('translations')
		                    	->with('user_creates')
		                    	->with('categories');
        //lay danh sach tin bat thuong
		$data = $this->newModel->select(DB::raw('1 as level'), 'news.id', 'title', 'view', 'vote', 'status', 'tag', 'hot', 'prioritize', 'description', 'url_image', 'created_at')
								->join('new_translation as t', 't.new_id', '=', 'news.id')
								->where( array(
									array('prioritize', 1),
									array('hot', 1)
								))
								->orWhere( array(
									array('prioritize', 1),
									array('hot', 0)
								))
								->where( array(
									array('locale', App::getLocale()),
									array('status', StatusConfig::CONST_AVAILABLE),
								))
								->unionAll($news_prioritize)
								->with('translations')
								->orderBy('level', 'desc')
								->orderBy('id', 'desc')
		                    	->with('user_creates')
		                    	->with('categories')
		                    	->limit($limit)
		                    	->get();
		// echo "<pre>";
		// var_dump($data->toSql());
		// return 123;
		return $data;
	}

	public function getNew($limit) {
		//lay danh sach tin binh thuong
		$news = $this->newModel->select('news.id', 'title', 'view', 'vote', 'status', 'tag', 'hot', 'prioritize', 'description', 'url_image', 'created_at')
		                    	->join('new_translation as t', 't.new_id', '=', 'news.id')
		                   	 	->where( array(
		                   	 		array('status', StatusConfig::CONST_AVAILABLE),
									array('locale', App::getLocale()),
									// array('prioritize', 0),
								))
		                    	->with('translations')
		                    	->with('user_creates')
		                    	->with('categories')
		                    	->orderBy('updated_at', 'desc')
		                    	->limit($limit)
		                    	->get();
		return $news;
	}

	public function getCategory() {
		$data = $categories = $this->categoryModel->select('categories.id', 'name', 'parent_id', 'depth', 'status', 'slug')
					            ->join('categories_translation as t', 't.category_id', '=', 'categories.id')
					            ->where('locale', App::getLocale())
					            ->where('categories.status', StatusConfig::CONST_AVAILABLE)
					            ->orderBy('depth','asc')
					            ->get();

		return $data;
	}

	public function getPeriod () {
		$data = $this->newModel->select(DB::raw('MONTH(updated_at) as month, YEAR(updated_at) as year'))
								->groupBy(DB::raw('MONTH(updated_at) + "." + YEAR(updated_at)'))
								->get();
		return $data;
	}

	public function getMagazine ($limit = null) {
		$data = $this->magazineModel::orderBy('sort_by' , 'asc')->limit($limit)->get();
		return $data;
	}

	public function getListMagazine() {
		
		$data = $this->magazineModel::orderBy('sort_by' , 'asc')->paginate(8);
		return $data;
	}


}



    
