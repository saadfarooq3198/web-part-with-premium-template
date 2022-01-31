<?php

namespace App\Http\Controllers;

use Exception;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Yoeunes\Toastr\Facades\Toastr;

class LinkedinController extends Controller
{
    public function linkedinRedirect()
    {
        return Socialite::driver('linkedin')->redirect();
    }
       

    public function linkedinCallback()
    {
        try {
     
            $user = Socialite::driver('linkedin')->user();
      
            $linkedinUser = User::where('linkedin_id', $user->id)->first();
      
            if($linkedinUser){
      
                Auth::login($linkedinUser);
     
                return redirect('/dashboard');
      
            }else{
                $email = User::all();
                foreach($email as $em){
                    if($em->email == $user->email){
                        toastr()->error('Email already Exist! Login here');
                        return redirect('/login');
                    }
                }
                $name = explode(" ", $user->name);
                $users = User::UpdateOrCreate([
                    'first_name' => array_shift($name),
                    'last_name' => implode(" ", $name),
                    'email' => $user->email,
                    'image' => 'user.jpg',
                    'password' => encrypt('Saad12345'),
                    'linkedin_id'=> $user->id,
                    'auth_type'=> 'Linkedin'
                ]);
                Auth::login($users);
                return redirect('/dashboard');
            }
     
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}