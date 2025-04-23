<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function applyVideoHistory(){
        if(Auth::check()){
            $user = User::where('id',auth()->user()->id)->with('videoDetail')->first();
            return view('pages.purchaser.apply-coins-history',compact('user'));
        }
    }

}
