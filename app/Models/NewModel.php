<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\MyModel;
use App\Libs\Configs\StatusConfig;

class NewModel extends MyModel
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

    public function filterTitle ($params) {
        if (!empty($params) ) {
            $this->setFunctionCond('whereTranslationLike', ['title', '%'.$params.'%']);
        }
        return $this;
    }

    public function filterTag ($params) {
        if (!empty($params) ) {
            $this->setFunctionCond('orWhereTranslationLike', ['tag', '%'.$params.'%']);
        }
        return $this;
    }

    public function filterContent ($params) {
        if (!empty($params) ) {
            $this->setFunctionCond('orWhereTranslationLike', ['content', '%'.$params.'%']);
        }
        return $this;
    }

    public function filterOnlyTag($params) {
        if (!empty($params) ) {
            $this->setFunctionCond('whereTranslationLike', ['tag', '%'.$params.'%']);
        }
        return $this;
    }

    public function filterFreeText ($params) {
        if (!empty($params) ) {
            // $this->setFunctionCond('where', ['status', StatusConfig::CONST_AVAILABLE ]);
            $this->filterTitle($params);
            $this->filterTag($params);
            $this->filterContent($params);
        }
        return $this;
    }

    public function filterDateMonth ($year, $month) {
        if (!empty($year) &&  !empty($month)) {
            $this->setFunctionCond('whereYear',  [ 'created_at', '=' , $year]);
            $this->setFunctionCond('whereMonth',  ['created_at', '=' , $month]);
        }
        return $this;
    }
}
