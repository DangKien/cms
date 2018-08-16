<?php

namespace App\Libs\Providers;

use App\Models\Tag as TagModel;
use App\Libs\Configs\StatusConfig;


class Tag {
	public function recordTag($id, $locale) {
		$tagModel = new TagModel();
		$data = $tagModel::findOrFail($id)->translate($locale);

		return $data;
	}


}



    
