<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class loginController extends Controller
{
    public function index(){
        return view('login');
    }
    public function check(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password' => 'required|min:8',
        ]);
        $user = User::where('email',$request->email)->first();
        if($user&& Hash::check($request->password,$user->password)){
            Auth::login($user);
            return to_route('dashboard')->with('success', 'Login successful!');
        }else{
            return redirect()->back()->with('error', 'Invalid email or password');
        }
    }
    public function dashboard(){
        if(auth::check()){
            $user = auth()->user()->user_type;
            if($user === 'purchase'){
                $loginuser          = User::where('id', auth()->id())->with('purchaserDetail')->first();
                $purchase_data      = $loginuser->purchaserDetail;
                $data=[
                  'user'            => $loginuser,
                  'purchase_data'   => $purchase_data,
                ];
                return view('pages.purchaser.dashboard',compact('data'))->with('success',"Welcome your are successfully logged in");
            }else{
                return view('pages.viewer.dashboard')->with('success',"Welcome your are successfully logged in");
            }
        }
    }
    public function logout (){
        $user = auth()->user();
        if($user){
            auth::logout();
            return to_route('login');
        }else{
            return back()->with('error',"you cannot access this page");
        }
    }
}
