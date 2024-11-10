<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CityGroup extends Model
{
    use HasFactory;

    protected $table = "group_cities";
    protected $guarded = [];

    public function Cities(){
        return $this->hasMany(City::class,'group_id','id');
    }
}
