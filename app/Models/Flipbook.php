<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\MyModel;

class Flipbook extends MyModel
{
    protected $table = "flipbooks";

    public function filterFreeText($params) {
    	if (!empty($params)) {
    		$this->setFunctionCond('where', [ 'title', 'like', "%".$params."%"]);
    	}
    	return $this;
    }
}
