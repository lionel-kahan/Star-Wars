<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Product extends Model
{
    protected $fillable = ['category_id', 'name', 'slug', 'price', 'abstract','content', 'quantity', 'status', 'published_at'];
    protected $dates = ['published_at'];
//    protected paginate=3;

    public function category() {
        return $this->belongsTo('App\Category'); //pas d'utilisation d'alias ici pour app\Category
    }

    public function tags() {
        return $this->belongsToMany('App\Tag');
    }

    public function picture() {
        return $this-> hasone('App\Picture');
    }

    public function getNameAttribute ($value) {
        return ucfirst($value);
    }

    //geter implicite ou  ACCESSOR
    public function getPublishedAtAttribute ($value) {
//        return $value->format('d/m/Y');
        return date('d/m/Y', strtotime($value));
    }

    //setter implicite ou MUTATOR
    public function setSlugAttribute($value) {
        $this->attributes['slug'] = (empty($value)) ? str_slug($this->name, '-') : str_slug($value, '-');
    }

    public function setPublishedAtAttribute($value) {
        $this->attributes['published_at'] = (empty($value)) ? Carbon::now() : Carbon::createFromFormat('d/m/Y', $value);
    }

    public function hasTag($tagId) {
        foreach($this->tags as $tag) {
            if ($tag->id == $tagId) return true;
        }
        return false;
    }

    public function scopeOnline($query) {
        return $query->where('status', '=', 'opened')->orderBy('published_at');
    }
}
