<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Flipbook;
use Session;

class MagazineController extends Controller
{
	public function __construct(Flipbook $flipbook)
	{
		$this->flipbookModel = $flipbook;
	}
    public function index () {
    	return view('Frontend.Contents.magazine.index');
    }

    public function detail ($id, $slug) {
    	app('CountView')->upView($this->flipbookModel, 'view', $id, 'magazine');
    	$magazine = $this->flipbookModel->findOrFail($id);
    	// return $magazine;
    	
    	return view('Frontend.Contents.magazine.detail', array('magazine' => $magazine));
    }
}
