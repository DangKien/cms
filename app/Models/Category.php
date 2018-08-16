<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use \Dimsav\Translatable\Translatable;

    protected $table = 'categories';

    protected $translationModel = "App\Models\CategoryTranslation"; 

    protected $translatedAttributes = ['name', 'description', 'slug', 'meta_title', 'meta_description', 'meta_data'];

    public $translationForeignKey = 'category_id';

    public function news() {
    	return $this->belongsToMany('App\Models\NewModel', 'new_category', 'category_id', 'new_id');
    }
}
