<?php

namespace App\Http\Controllers\Balance;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class BalanceController extends Controller
{
    public function index(){
        return view('balance.index');
    }

    public function pending(){
        return view('balance.pending');
    }

    public function confirm(){
        return view('balance.confirm');
    }

    public function search(){
        return view('balance.search');
    }
}
