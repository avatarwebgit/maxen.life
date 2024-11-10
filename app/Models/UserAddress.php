<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserAddress extends Model
{
    use HasFactory ,SoftDeletes;

    protected $table = "user_addresses";
    protected $guarded = [];
    public function User(){
        return $this->belongsTo(User::class);
    }
       public function Order()
    {
        return $this->hasMany(Order::class,'address_id');
    }

}
