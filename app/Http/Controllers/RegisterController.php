<?php

namespace App\Http\Controllers;

use App\Models\Authentication;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    //Store User Details Here
    public function store(Request $request)
    {
        //dd($request->all());
        $user = $request->except('_token');

        $user_id = $request->input('user_id');

        if($user_id == 0)
        {            
            $request->validate([
                'name' => 'required',
                'lname' => 'required',
                'email' => 'required|unique:users,email|email',
                'mobile' => 'required|unique:users,mobile|numeric',
                'password' => 'required|confirmed',
                'address' => 'required',
                'landmark' => 'required',
                'city' => 'required',
                'country' => 'required',
                'postcode' => 'required'
            ]);

            $user = new User;
            $user->name = $request->input('name');
            $user->lname = $request->input('lname');
            $user->usertype = 'User';
            $user->email = $request->input('email');
            $user->mobile = $request->input('mobile');
            $user->address = $request->input('address');
            $user->password = Hash::make($request->input('password'));
            $user->landmark = $request->input('landmark');
            $user->city = $request->input('city');
            $user->country = $request->input('country');
            $user->postcode = $request->input('postcode');
            $user->save();

            Auth::login($user);
        } 
        else 
        {            
            $request->validate([
                'name' => 'required',
                'lname' => 'required',
                'password' => 'required|confirmed',
                'address' => 'required',
                'landmark' => 'required',
                'city' => 'required',
                'country' => 'required',
                'postcode' => 'required'
            ]);

            DB::table('users')->where('id', $user_id)->update(array(
                'name'=>$request->input('name'),
                'lname'=>$request->input('lname'),
                'usertype'=> 'User',
                'password' => Hash::make($request->input('password')),
                'address'=>$request->input('address'),
                'landmark'=>$request->input('landmark'),
                'city'=>$request->input('city'),
                'country'=>$request->input('country'),
                'postcode'=>$request->input('postcode')
            ));
        }
        
        if (!empty(Auth::id()) && Auth::user()->usertype == 'User')
        {
            $UserId = Auth::id();

            $query9 = DB::table('temporary_carts')
            ->where('user_id','=', $UserId)
            ->count('user_id');
            $res['cart_count'] = $query9;

        } 
        else { $res['cart_count'] = 0; }

        return redirect('/shop', $res);
    }

    //Store Authentication Here
    public function login_authority(Request $request)
    {
        $data = $request->except('_token');

        $auth_id = $request->input('auth_id');

        if(empty($auth_id))
        {
            $request->validate([
                'authentication' => 'required',
                'address' => 'required',
                'user_name' => 'required',
                'email' => 'required|unique:users,email|email',
                'mobile' => 'required|unique:users,mobile|numeric',
                'password' => 'required'
            ]);

            $user = new User;
            $user->name = $request->input('user_name');
            $user->usertype = $request->input('authentication');
            $user->email = $request->input('email');
            $user->mobile = $request->input('mobile');
            $user->address = $request->input('address');
            $user->password = Hash::make($request->input('password'));
            $user->save();
    
            return back()
            ->withSuccess('Authentication Added Successfully!'); 

        }
        else
        {
            $request->validate([
                'authentication' => 'required',
                'address' => 'required',
                'user_name' => 'required',
                'mobile' => 'required',
                'email' => 'required',
                'password' => 'required'
            ]);

            DB::table('users')->where('id', $auth_id)->update(array(
                'usertype'=>$request->input('authentication'),
                'address'=>$request->input('address'),
                'name'=>$request->input('user_name'),
                'mobile'=>$request->input('mobile'),
                'email'=>$request->input('email'),
                'password' => Hash::make($request->input('password'))
            ));

            return back()
            ->withSuccess('Authentication Updated Successfully!'); 
        }
    }
}
