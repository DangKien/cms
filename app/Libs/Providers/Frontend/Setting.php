<?php

namespace App\Libs\Providers\Frontend;

use App\Libs\Configs\StatusConfig;
use App\Models\Setting as SettingModel;
use App, DB;

class Setting {

	private $menuModel, $newModel;

	public function __construct()
	{
		$this->settingModel = new SettingModel();
	}

	public function getGgAnalytic() {

		$data = $this->settingModel->where('key', "GOOGLE_ANALYTIC")
							 ->first();

		if (!empty($data->setting)) {
			$data->setting = json_decode($data->setting);
		}
		return $data;
	}

	public function getContact() {
		$data = $this->settingModel->where('key', "CONTACT")
							 ->first();

		if (!empty($data->setting)) {
			$data->setting = json_decode($data->setting);
		}
		return $data;
	}

	public function getMeta() {
		$data = $this->settingModel->where('key', "META")
							 ->first();

		if (!empty($data->setting)) {
			$data->setting = json_decode($data->setting);
		}
		return $data;
	}

}



    
