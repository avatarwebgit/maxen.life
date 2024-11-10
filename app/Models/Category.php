<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = "categories";
    protected $guarded = [];

    public function getIsActiveAttribute($is_active)
    {
        return $is_active ? 'فعال' : 'غیرفعال' ;
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function Products(){
        return $this->belongsToMany(Product::class);
    }
    public function Articles(){
        return $this->belongsToMany(Article::class);
    }
    public function OfferProducts(){
        return $this->belongsToMany(
            Product::class,
            'category_offer_product',
            'category_id','product_id','id','id');
    }
    public function Measures(){
        return $this->belongsToMany(Measure::class,
            'category_measure',
        'category_id','measure_id','id','id');
    }

    public function PeykPrice(){
        return $this->hasMany(PeykPrice::class,'category_id','id');
    }
}
