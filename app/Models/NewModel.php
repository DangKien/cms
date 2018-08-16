<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewModel extends Model
{
    use \Dimsav\Translatable\Translatable;
    
    protected $table = 'news';

    protected $translationModel = "App\Models\NewTranslation"; 

    protected $translatedAttributes = ['title', 'slug', 'description', 'content', 'tag', 'meta_keyword', 'meta_description', 'meta_content', 'meta_title'];

    public $translationForeignKey = 'new_id';

    public function categories() {
    	return $this->belongsToMany('App\Models\Category', 'new_category', 'new_id', 'category_id');
    }

    public function user_creates() {
    	return $this->belongsTo('App\User', 'user_create', 'id');
    }

}
