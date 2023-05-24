<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Symfony\Contracts\Service\Attribute\Required;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\services\EmailService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
  
     public function forgot_password(Request $request)
     {
         if ($request->isMethod('post')) {
             $email = $request->input('email');
             $user = DB::table('users')->where('email', $email)->first();
             if ($user) {

               $full_name=$user->name;
               $activation_token=md5(uniqid()).$email.sha1($email);
               $mailresetpwd=new EmailService;
               $subject='réinitialisez votre mot de passe';
               $msg="nous venons d'envoyer votre demande de réinitialisation de mot de passe, veuillez vérifier votre boîte d'email";
               
               DB::table('users')
               ->where('email',$email)
               ->update(['remember_token'=>$activation_token]);


               //dd($activation_token);
               $mailresetpwd->resetPassword($subject,$email,$full_name,true,$activation_token);
               return back()->withErrors(['email-success'=>$msg])
               ->with('oldemail',$email)
               ->with('success',$msg);
            } else {
                $msg="l'email que vous avez saisi n'existe pas";
                return back()->withErrors(['email-erreur'=>$msg])
                            ->with('oldemail',$email)
                            ->with('danger',$msg);
             }
         }
     
         return view('auth.forgot-password');
     }
     public function changePassword( Request $request)
     {
        
        $token=$request->token;
             
            if( $request->input('password')==$request->input('confirmerpassword'))
            {
              
               
                $user = DB::table('users')->where('remember_token',$token)->first();
    
                $pass=$request->input('password');
                  //dd($user);
                  DB::table('users')
                  ->where('remember_token',$token)
                  ->update(['password'=>Hash::make($pass)]);
    
                $msg='mot de passe modifier avec success';
                  
                  return redirect('/loginn')->with(['email-sucessc'=>$msg])
                                           ->with('user',$user)
                                           ->with('success',$msg);
         }else {
            $msg="le mot de passe et non confirmer";
            return back()->withErrors(['email-erreur'=>$msg])
                        
                        ->with('danger',$msg);
         }
        }
           
       
     
public function changePasswordview($token)
{
     $user=DB::table('users')
     ->where('remember_token',$token)
     ->first();
     //dd($user);
     return view('auth.changePassword')->with('token',$token)->with('user',$user);
}
   
    
}
