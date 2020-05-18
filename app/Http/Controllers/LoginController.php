<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

use DB;
use Auth;
use App\User;
use App\Role;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class LoginController extends Controller {

    public function phpinfo(){
        phpinfo();
    }

    public function login(Request $request){

        if(Auth::attempt([
            'email'=>$request->email,
            'password'=>$request->password
            ])){
            return redirect('employees');
        }
        else{
            return redirect('login')->with('status', 'Login failed; Invalid email or password.');
        }
    }

    public function logout(Request $request){
        return redirect('login')->with(Auth::logout());
    }

}
