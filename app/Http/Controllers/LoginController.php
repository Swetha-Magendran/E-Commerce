<?php

namespace App\Http\Controllers;

use App\Models\Authentication;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
        $id = Auth::id();

        if(empty($id))
        {
            $request->validate(
                [
                    'email' => 'required',
                    'password' => 'required'
                ]
            );

            $email = $request->input('email');
            $password = $request->input('password');

            if(Auth::attempt(['email' => $email, 'password' => $password]))
            {
                $user = User::where('email',$email)->first();
                Auth::login($user);
                
                return redirect("/shop");
            }
        }
        else
        {            
            return back()->withSuccess('Admin logged in already. You are not allow to login!');
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/login');
    }

    //Admin login verification here
    public function login_authentication(Request $request)
    {
        //dd($request->all());
        $id = Auth::id();

        if(empty($id))
        {
            $request->validate(
                [
                    'authentication' => 'required',
                    'email' => 'required',
                    'password' => 'required'
                ]
            );

            $email = $request->input('email');
            $password = $request->input('password');

            if(Auth::attempt(['email' => $email, 'password' => $password]))
            {
                $user = User::where('email',$email)->first();
                Auth::login($user);
                
                
                return redirect()->route('admin_index');
                //return redirect('admin.index');
            }
            else
            {
                return back()->withErrors(['Invalid Credentials']);
            }
        }
        else
        {
            return back()->withSuccess('User logged in already. You are not allow to login!');
        }
        
    }

    public function admin_logout()
    {
        Auth::logout();

        return redirect('/admin_login');
    }
}
