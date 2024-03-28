<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Product extends Model
{
    use HasFactory;
    use Sortable;

    protected $table='products';
    protected $fillable=['name','price','sale_price','color','brand',
                        'product_code','function','stock','description',
                        'image'];
}
