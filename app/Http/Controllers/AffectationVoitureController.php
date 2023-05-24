<?php

namespace App\Http\Controllers;

use App\Models\affectationVoiture;
use Illuminate\Http\Request;
use App\Models\conducteurs;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class AffectationVoitureController extends Controller
{
    public function index()
    {
        $affectations = DB::table('affectation_voitures')
        ->where('archived_at', null)
        ->get();
       
        return view('Admin.affectation.index')->with('affectations', $affectations);
    }

    public function search(Request $request){
        $query = $request->get('query');
        $affectations = DB::table('affectation_voitures')
        ->where('archived_at', null)
        ->where('Matricule',$query)
        ->get();
        return view('Admin.affectation.index')->with('affectations', $affectations);

    }

    public function affecter(Request $request)
    {
        $request->validate(
            [
                'matricule' => 'required',
                'CINC'=>'required'
            ]
        );
        $affectation=new affectationVoiture();
        $affectation->Matricule=$request->matricule;
        $affectation->CINC=$request->CINC;
        $affectation->date_affectation=now();
        $conducteur=DB::table('conducteurs')->where('CINC',$request->CINC)->first();
        $user=new user();
        $user->email= $conducteur->email;
        $user->password=$conducteur->password;
        $user->name=$conducteur->nom;
        $user->role='user';
        //dd($affectation);
        if($affectation->save()){
            $user->save();
            $affectation =  DB::table('affectation_voitures')
            ->where('Matricule', $request->matricule)
            ->where('archived_at', null)
            ->get();
            $conducteurs= DB::table('conducteurs')
            ->where('archived_at', null)
            ->get();
            
           
            
            
            return view('Admin.voitures.affectation.affect')->with('affectation',$affectation)->with('conducteurs',$conducteurs);
            // return view('Admin.voitures.affectation.nonaffect')->with('matricule', $affectation->Matricule)->with('success', 'Votre affectation a été envoyé avec succès.')->with('conducteurs',$conducteurs);
      
        }
    }

    public function update(Request $request){
        $matricule=$request->matricule;
        $CINC=$request->CINC;
        $aff=DB::table('affectation_voitures')->where('archived_at', null)->where('matricule',$matricule)->first();
        $cond=DB::table('conducteurs')->where('CINC',$aff->CINC)->first();
        $user=DB::table('users')->where('email',$cond->email)->delete();
       

        DB::table('affectation_voitures')
        ->where('Matricule', $matricule)
        ->update(['archived_at' => now()]);
        
       

       /* $affectation =  DB::table('affectation_voitures')
        ->where('Matricule', $matricule)
        ->where('archived_at', null)
        ->get();
        $conducteurs= DB::table('conducteurs')
        ->where('archived_at', null)
        ->get();
        $user=new user();
        $user->email= $conducteurs->email;
        $user->password=$conducteurs->password;
        $user->name=$conducteurs->nom;
        $user->role='user';
        $user->save();
         return view('Admin.voitures.affectation.affect')->with('affectation',$affectation)->with('conducteurs',$conducteurs);*/
       
      return $this->affecter($request);
        
       
    }


    public function archive($CINC){
        $email=DB::table('conducteurs')
        ->where('CINC', $CINC)
        ->first();
        DB::table('affectation_voitures')
        ->where('CINC', '=', $CINC)
        ->update(['archived_at' => now()]);
        $conducteurs= DB::table('conducteurs')
        ->where('archived_at', null)
        ->get();

        DB::table('users')->where('email',$email->email)->delete();
        $matricule =  DB::table('affectation_voitures')
        ->select('Matricule')
        ->where('CINC', $CINC)
        ->get()
        ->pluck('Matricule')
        ->first(); 
       
        
        
        return view('Admin.voitures.affectation.nonaffect')->with('conducteurs',$conducteurs)->with('matricule',$matricule);

    }
}
