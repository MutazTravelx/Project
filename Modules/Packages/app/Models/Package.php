<?php

namespace Modules\Packages\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Packages\Database\Factories\PackageFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

// use Modules\Packages\Database\Factories\PackageFactory;

class Package extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name','description','destination','duration','time',
    ];

    public function price ():HasMany    
    {
        return $this->hasMany(Price::class,'package_id');
    }    

    protected static function newFactory()
    {
        return PackageFactory::new();
    }
}
