<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

use App\Products;
class Category extends Model implements HasMedia
{
	use HasMediaTrait;
    public $table = 'categories';

    protected $fillable = [
    	'parent_id',
    	'title',
    	'description',
    	'created_at',
    	'deleted_at'
    ];

    public function registerMediaCollections()
	{
	    $this->addMediaCollection('cat_image');
	}

	public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
              ->width(80)
              ->height(80);
    }

    public function getImageAttribute()
    {
    	$file = $this->getMedia('cat_image')->last();
    	if ($file){
    		$file->url = $file->getUrl();
    		$file->thumbnail = $file->getUrl('thumb');
    	}
    	return $file;
    }
    public function categoryProducts()
    {
        return $this->belongsToMany(Products::class);
    }

}
