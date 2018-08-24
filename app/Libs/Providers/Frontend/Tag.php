<?php

namespace App\Libs\Providers\Frontend;

use App\Libs\Configs\StatusConfig;
use App\Models\Tag as TagModel;
use App, DB;

class Tag {

	private $menuModel, $newModel;

	public function __construct()
	{
		$this->tagModel = new TagModel();
	}

	public function listTag() {
		$data = $this->tagModel->where('status', StatusConfig::CONST_AVAILABLE)
							   ->get();

		return $data;
	
	}
}



    
