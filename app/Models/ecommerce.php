<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;


class ecommerce extends Authenticatable
{
    use HasFactory, Notifiable;
    use Sortable;

    protected $table='e-commerces';
    protected $fillable=['fname','lname', 'username','email','password','country', 'city','gender','photo','role'];
    public function commentData(){
        return $this->hasOne(Comment::class);
    }
}
