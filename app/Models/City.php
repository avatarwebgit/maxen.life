<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use HasFactory;

    protected $table = "cities";
    protected $guarded = [];

    public function Group()
    {
        return $this->belongsTo(CityGroup::class,'group_id','id');
    }
}
