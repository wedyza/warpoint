<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded = [];
    public function carts(){
        return $this->belongsToMany(Cart::class, "orders_carts");
    }
}
