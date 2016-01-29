<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    protected $fillable = ['id', 'product_id', 'uri', 'title', 'size','type'];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}