<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GoodsController extends Controller
{
    
     public function store($id)
    {
        \Auth::user()->good($id);
        return back();
    }
    
     public function destroy($id)
    {
        \Auth::user()->ungood($id);
        return back();
    }
}
