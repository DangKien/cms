<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
	use \Dimsav\Translatable\Translatable;

    protected $table = "menu";

    protected $translationModel = "App\Models\MenuDetail"; 

    protected $translatedAttributes = ['data_menu'];

    public $translationForeignKey = 'menu_id';
}
