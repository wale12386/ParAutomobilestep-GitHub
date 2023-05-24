<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


use Illuminate\Http\Request;

class user extends Controller
{
    public function viewlogin(){
        return view('auth.login');
    }
    public function login(Request $request)
{
    $request->validate(
        [
            'email' => 'required|email',
            'password' => 'required',
        ]
    );
    $email = $request->email;
    $password = $request->password;
    // Vérifier si le conducteur existe dans la table conducteurs
    $driver = DB::table('users')
                ->where('email', $email)
                //->where('password',Hash::make($password) )
                //->where('archived_at', null)
                ->first();
                //dd(Hash::make($password));
               // dd($driver);
            //$res=password_verify($password, $driver->password);
            //dd($res);
            $driver2 = DB::table('conducteurs')
            ->where('email',$email)
            
            ->where('archived_at', null)
            ->first();
           // dd($driver2);
    // Si le conducteur existe, chercher une affectation avec son nom
  
    if ($driver&& password_verify($password, $driver->password)) 
    
    {
        //dd($driver);
        if( $driver->role=='user')
        {
            //dd($driver->role);
           
            $affectation = DB::table('affectation_voitures')
            ->where('CINC', $driver2->CINC)
            ->where('archived_at', null)
            ->first();               

            if ($affectation) {
                // Si une affectation existe, récupérer la matricule
                $matricule = $affectation->Matricule;
                return view('conducteur.dashbord')->with('matricule', $matricule);
            } else {
                // Si aucune affectation n'existe, retourner un message d'erreur
                return back()->withErrors(['error' => 'Aucune affectation trouvée pour ce conducteur.'])
            ->with('danger','Aucune affectation trouvée pour ce conducteur.');
            }
        }else{
            //dd('existe');
            return view('Admin.dashbord');
        }
    }elseif($driver2){
        $msg="n'existe pas une affectation avec cette compte ";
        return back()->withErrors(['error' => $msg])
        ->with('danger',$msg);
    }else{
        $msg="cete compte n'existe pas  ";
        return back()->withErrors(['error' => $msg])
        ->with('danger',$msg);
    }
}

    public function loginn(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required',
            ]
        );
        $email = $request->email;
        $password = $request->password;
    
        $driver = DB::table('conducteurs')
            ->where('email', $email)
            ->where('password', $password)
            ->where('archived_at', null)
            ->first();
    
        if ($driver) {
            $matricule = $driver->matricule;
            return redirect("/conducteur/dashbord")->with('matricule', $matricule);
        }
    
        return redirect()->intended($this->redirectPath());
    }
}
