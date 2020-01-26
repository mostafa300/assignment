<?php

namespace App;
use App\Category;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;


class Products extends Model implements HasMedia
{
    use HasMediaTrait;
    public $table = 'products';

    protected $fillable = [
    	'title',
    	'slug',
    	'price',
    	'description',
    	'created_by',
    	'created_at',
    	'deleted_at'
    ];

    public function categories ()
    {
    	return $this->belongsToMany(Category::class);
    }

    public function registerMediaCollections()
	{
	    $this->addMediaCollection('pro_image');
	}

	public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
              ->width(80)
              ->height(80);
    }

    public function getImageAttribute()
    {
    	$files = $this->getMedia('pro_image');
        $files->each(function ($item) {
            $item->url       = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
        });

        return $files;
    }
}
