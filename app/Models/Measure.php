<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Measure extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function Categories(){
        return $this->belongsToMany(Category::class
        ,'category_measure',
        'measure_id',
        'category_id',
        'id',
        'id');
    }
}
