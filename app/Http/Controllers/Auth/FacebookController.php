<?php
  

namespace App\Http\Controllers\Auth;

use Exception;
use Validator;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class FacebookController extends Controller
{
    
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleFacebookCallback()
    {
        try {
    
            $user = Socialite::driver('facebook')->user();
            
            $finduser = User::where('facebook_id', $user->id)->first();
            if($finduser){
     
                Auth::login($finduser);
    
                return redirect('/dashboard');
     
            }else{
                $email = User::all();
                foreach($email as $em){
                    if($em->email == $user->email){
                        toastr()->success('Email already Exist! Login here');
                        return redirect('/login');
                    }
                }
                $newUser = User::create([
                    'first_name' => $user->name,
                    'last_name' => $user->name,
                    'email' => $user->email,
                    'facebook_id'=> $user->id,
                    'password' => encrypt('Saad12345')
                ]);
    
                Auth::login($newUser);
     
                return redirect('/dashboard');
            }
    
        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }
}