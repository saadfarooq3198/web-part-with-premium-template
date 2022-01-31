<?php
namespace App\Http\Controllers;

use Exception;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GitHubController extends Controller
{

    public function gitRedirect()
    {
        return Socialite::driver('github')->redirect();
    }
       

    public function gitCallback()
    {
        try {
     
            $user = Socialite::driver('github')->user();
      
            $searchUser = User::where('github_id', $user->id)->first();
      
            if($searchUser){
      
                Auth::login($searchUser);
     
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
                    'github_id'=> $user->id,
                    'auth_type'=> 'github'
                ]);
                Auth::login($gitUser);
      
                return redirect('/dashboard');
            }
     
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}