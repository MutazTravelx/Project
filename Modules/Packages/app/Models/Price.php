<?php

namespace Modules\Packages\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Price extends Model
{
    protected $fillable = [
        'package_id','number_of_people','price',
    ];


    
    public function package ():BelongsTo    
    {
        return $this->belongsTo(Package::class,'package_id');
    }

}
