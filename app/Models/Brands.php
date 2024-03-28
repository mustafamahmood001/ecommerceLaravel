<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Brands extends Model
{
    use HasFactory;
    use Sortable;

    protected $table='brands';
    protected $fillable=[
      'name',
      'description',
      'photo',
      'is_active',

    ];
}
