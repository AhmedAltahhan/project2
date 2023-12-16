<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Course extends Model implements HasMedia
{
    use HasFactory ,InteractsWithMedia ,SoftDeletes;

    protected $fillable = [
        'name',
        'package_id',
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function purchaseable(): MorphOne
    {
        return $this->morphOne(Purchase::class, 'purchaseable');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('course')
             ->singleFile();
    }
}
