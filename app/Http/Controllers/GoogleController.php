<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
  
class GoogleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
       
        return Socialite::driver('google')->redirect();
    }
        
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        try {
      
            $user = Socialite::driver('google')->user();
            $finduser = User::where('google_id', $user->id)->first();
       
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
                $name = explode(" ", $user->name);
                $gitUser = User::create([
                    'first_name' => array_shift($name),
                    'last_name' => implode(" ", $name),
                    'email' => $user->email,
                    'image' => 'user.jpg',
                    'password' => encrypt('Saad12345'),
                    'google_id'=> $user->id,
                    'auth_type'=> 'Google'
                ]);
                Auth::login($gitUser);
      
                return redirect('/dashboard');
            }
      
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}