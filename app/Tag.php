<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name'];

    public function products() {
        return $this->belongsToMany('App\Product');
    }

    public function setSlugAttribute($value) {
        $this->attributes['slug'] = (empty($value)) ? str_slug($this->name, '-') : str_slug($value, '-');
    }
}
