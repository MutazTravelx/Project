<?php

namespace Modules\Packages\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Packages\Database\Factories\PackageFactory;

class Package extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name','images','description','destination','duration','price1','price2','price3','price4','time',
    ];

    protected function casts(): array
    {
        return [
            'images' => 'array',
        ];
    }
    // protected static function newFactory(): PackageFactory
    // {
    //     // return PackageFactory::new();
    // }
}
