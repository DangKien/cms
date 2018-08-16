<?php

namespace App\Libs\Providers;

use App\Models\Category as CategoryModel;
use App\Libs\Configs\StatusConfig;
use App\Models\NewModel;


class News {

	private $newModel;

	public function __construct()
	{
		$this->newModel = new NewModel();
	}

	public function recordNew($id, $locale) {
		$data = $this->newModel::findOrFail($id)->translate($locale);
		return $data;
	}


}



    
