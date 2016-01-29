<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Model;

class Command extends Model
{
    protected $fillable = ['customer_id', 'price', 'nb_product', 'commanded_at', 'status'];

    public function setCommandedAtAttribute($value) {
        $this->attributes['commanded_at'] = (empty($value)) ? Carbon::now() : Carbon::createFromFormat('d/m/Y', $value);
    }

    public function customer() {
        return $this->belongsTo('App\Customer');
    }

    public function commandDetails () {
        return $this->hasMany('App\CommandDetail');
    }
}
