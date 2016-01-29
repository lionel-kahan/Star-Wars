<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function products () {
        return $this->hasMany('App\Product');
    }

    public function setSlugAttribute($value) {
        $this->attributes['slug'] = (empty($value)) ? str_slug($this->title, '-') : str_slug($value, '-');
    }
}
