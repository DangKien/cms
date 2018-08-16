<?php

namespace App\Libs\Configs;

use App\Libs\Configs\StatusConfig;


class ArrayConfig {

	public static function locationMenu() {
		$data = array( 
			array( "key" => StatusConfig::CONST_MAIN_MENU, "name" => trans('backend.menu.main_menu')),
			array( "key" => StatusConfig::CONST_FOOTER_MENU, "name" => trans('backend.menu.footer_menu')),
		);

		return $data;
	}
	
}



    
