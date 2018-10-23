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
<<<<<<< HEAD
		$data = $this->settingModel->where('key', "META_SEO")
=======
		$data = $this->settingModel->where('key', "META")
>>>>>>> bcb538fb98ef3a05284e1cbc978fa3f9d722c37c
							 ->first();

		if (!empty($data->setting)) {
			$data->setting = json_decode($data->setting);
		}
		return $data;
	}

    public function getBanner() {
        $data = $this->settingModel->where('key', "BANNER")
            ->first();

        if (!empty($data->setting)) {
            $data->setting = json_decode($data->setting);
        }
        return $data;
    }
    public function getSeo() {

    }

}



    
