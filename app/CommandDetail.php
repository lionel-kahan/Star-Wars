<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommandDetail extends Model
{
    protected $fillable = ['command_id', 'product_id', 'price', 'quantity'];
    protected $table = 'command_details';

    public function command() {
        return $this->belongsTo('App\Command');
    }

    public function product() {
        return $this->belongsTo('App\Product');
    }
}
