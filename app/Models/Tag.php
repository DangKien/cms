<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class Tag extends Model
{
    use Translatable;
    protected $blog = 'tags';

    protected $translationModel = "App\Models\TagTranslation"; 

    protected $translatedAttributes = ['name', 'description'];

    public $translationForeignKey = 'tag_id';
}
