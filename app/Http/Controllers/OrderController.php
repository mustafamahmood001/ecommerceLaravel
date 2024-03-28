<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\Comment;
use Illuminate\Http\Request;

class OrderController extends Controller
{
   public function indexOrder(){

$comment=Comment::all();
$cart=cart::all();

    return view('dashboard.orders.indexorder',compact('comment','cart'));
   }
}
