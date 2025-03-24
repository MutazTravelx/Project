<?php

namespace Modules\Packages\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Packages\Database\Factories\PackageFactory;

// use Modules\Packages\Database\Factories\PackageFactory;

class Package extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name','images','description','destination','duration','time',
    ];

    public function price ():HasMany    
    {
        return $this->hasMany(Price::class,'package_id');
    }    

    protected function casts(): array
    {
        return [
            'images' => 'array',
        ];
    }
    protected static function newFactory()
    {
        return PackageFactory::new();
    }
}
