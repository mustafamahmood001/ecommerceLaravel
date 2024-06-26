<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    use HasFactory;
    protected $table='carts';
    protected $fillable=[ 
        'user_id',
        'product_id',
        'quantity'
    ];
    public function getProductData(){
        return $this->hasOne(Product::class,'id','product_id');
    }
}
