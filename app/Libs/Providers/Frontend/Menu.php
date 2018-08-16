<?php

namespace App\Libs\Providers\Frontend;

use App\Models\Menu as MenuModel;
use App\Libs\Configs\StatusConfig;

class Menu {

	private $menuModel;

	public function __construct()
	{
		$this->menuModel = new MenuModel();
	}

	public function getMenu() {
		$data = $this->menuModel::select('*')
								->where([
									['status', StatusConfig::CONST_AVAILABLE],
									['location', StatusConfig::CONST_MAIN_MENU]])
								->first();
		if (!empty($data->data_menu)) {
			$data->data_menu = json_decode($data->data_menu);
		}
		return $data;
	}

}



    
