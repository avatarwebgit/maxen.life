<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeykPrice extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function City(){
        return $this->belongsTo(City::class,'city_id','id');
    }
}
