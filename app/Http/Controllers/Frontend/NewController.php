<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\NewModel; 
use App;

class NewController extends Controller
{
	private $newModel;
	public function __construct(NewModel $newModel)
	{
		$this->newModel = $newModel;
	}
    public function detail ($id, $slug, Request $request) {
    	$new  = $this->newModel->with(['user_creates' => function ($q) {
    								$q->select('users.id', 'name');
    							}])
                               ->with(['categories' => function ($q) {
    								$q->select('categories.id', 'name')
									->join('categories_translation as t', 't.category_id', '=', 'categories.id')
						            ->where('locale', App::getLocale())
						            ->orderBy('depth','asc')
						            ->get();
    							}])
                               ->findOrFail($id);
        return view('Frontend.Contents.new.detail', array('new'=>$new));

    }
}
