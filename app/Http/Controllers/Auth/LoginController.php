<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;

//importaciones para la vista login
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Rol;
use App\Models\Users;

class LoginController extends Controller
{
  public function showLoginForm(){
      return view('auth.login');
  }

  public function login(Request $request){
     $this->validateLogin($request);

      if(Auth::attempt(['nomusuario'=> $request->nomusuario,'password'=> $request->password,'estado'=>1])){
          return redirect()->route('main');
      }

      return back()
      ->withErrors(['nomusuario' => trans('auth.failed')])
      ->withInput(request(['nomusuario']));
  }

  protected function validateLogin(Request $request){
    $this->validate($request,[
        'nomusuario' => 'required|string',
        'password' => 'required|string' 
      ]);
  }

  public function logout(Request $request){
    Auth::logout();
    $request->session()->invalidate();
    return redirect()->route('login');

}

}