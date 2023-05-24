<?php

namespace App\Http\Controllers;

use App\Models\conducteurs;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class ConducteursController extends Controller
{

    public function dashbord()
    {
        return view('conducteur.dashbord');
    }
    public function dashbord2($matricule)
    {
        return view('conducteur.dashbord')->with('matricule', $matricule);
    }
    public function detail ($matricule)
    {
        $assurances=DB::table('assurances')
        ->where('Matricule', '=', $matricule)
        ->where('archived_at', null)

     
        ->get();
        $reparations=DB::table('reparations')
        ->where('Matricule', '=', $matricule)
        ->where('archived_at', null)
        ->get();

        $accidents=DB::table('accidents')
        ->where('Matricule', '=', $matricule)

        ->get();
        $constats= DB::table('constats')
        ->where('vehicule_id', '=', $matricule)

        ->get();
        $deplacements=DB::table('deplacements')
        ->where('Matricule', '=', $matricule)        
        ->get();

        $echanges= DB::table('echanges')
        ->where('Matricule', '=', $matricule)    
        

        ->get();
        $entretiens= DB::table('entretiens')
        ->where('Matricule', '=', $matricule)       
        

        ->get();
        $taxes= DB::table('taxes')
        ->where('Matricule', '=', $matricule)        ->where('archived_at', null)

        ->get();
        $vidanges= DB::table('vidanges')
        ->where('Matricule', '=', $matricule)       
        ->get();
        $visites= DB::table('visites_techniques')        ->where('archived_at', null)

        ->where('Matricule', '=', $matricule)
        ->get();

    return view('conducteur.detail')->with('assurances', $assurances)->with('accidents', $accidents)
    ->with('constats', $constats)->with('deplacements', $deplacements)->with('echanges', $echanges)
    ->with('entretiens', $entretiens)->with('taxes', $taxes)->with('vidanges', $vidanges)
    ->with('visites', $visites)->with('matricule', $matricule)->with('reparations', $reparations);
    }
    public function archive($CINC)
    {
        $conducteur = conducteurs::findOrFail($CINC);
        $userid=DB::table('users')
        ->where('email', '=', $conducteur->email)
        ->select('id')
        ->first();   
        //     dd($userid);
        $user=user::find($userid->id);
       // dd($user);
       // dd($conducteur->email);
        
        $conducteur->archived_at = now();

       // dd($conducteur->email);
       // dd($user);
        if($conducteur->update())
        {
            $user->delete();
            return redirect()->back();

        }
    }
    


    public function index()
    {
        $conducteurs = DB::table('conducteurs')
        ->where('archived_at', null)
        
        ->get();
       
        return view('Admin.conducteur.index')->with('conducteurs', $conducteurs);
    }
    public function search(Request $request){
        $query = $request->get('query');
        $conducteurs = DB::table('conducteurs')
        ->where('archived_at', null)
        ->where('nom',$query)
        ->get();
        return view('Admin.conducteur.index')->with('conducteurs', $conducteurs);

    }

    public function formul()
    {
       
        return view('Admin.conducteur.formul');
    }
    public function store(Request $request)
    {
        $request->validate(
            [
                'CINC'=>'required|unique:conducteurs',
                'nom'=>'required',
                'prenom'=>'required',
                'date_naissance'=>'required|date_format:Y-m-d',
                'photo'=>'required',
                'telephone'=>'required',
                'email'=>'required|unique:conducteurs',
                'password'=>'required',
                




            ]
        );
        $conducteur=new conducteurs();
        $conducteur->CINC=$request->CINC;
        $conducteur->nom=$request->nom;
        $conducteur->prenom=$request->prenom;
        $conducteur->adresse=$request->adresse;
        $conducteur->telephone=$request->telephone;
        $conducteur->email=$request->email;
        $conducteur->password=Hash::make($request->password);
       





        $dateString = $request->date_naissance;
        $date = Carbon::parse($dateString)->format('Y-m-d');
        $conducteur->date_naissance = $date;

        $rename = uniqid();
        $image = $request->file('photo');
        //dd($image);
        $rename .= "." . $image->getClientOriginalExtension();
        $destinationPath = 'uploads';
        $image->move($destinationPath, $rename);
        $conducteur->photo = $rename;

     
        
      
      //dd($conducteur);
       if($conducteur->save()){
        
        $msg="Le conducteur  est ajouté avec success ";
        return redirect('/admin/conducteur')
        ->withErrors(['error' => $msg])
                ->with('success',$msg);
  
    }
    }

    public function updatepassword(Request $request)
    {
        $id=$request->id;
        $conducteur=conducteurs::find($id);
        $user=user::find($conducteur->email);
        //dd($user);
        $conducteur->password=Hash::make($request->password);
        $user->password=Hash::make($request->password);
        dd($user->password);
        if($conducteur->update()){
            $user->update();
            return redirect('/admin/conducteur');
      
        }
    }
    




    public function profil($matricule)
    {
        $affectation=DB::table('affectation_voitures')->where('Matricule',$matricule)->where('archived_at',null)->first();
            $conducteur=DB::table('conducteurs')->where('CINC',$affectation->CINC)->where('archived_at',null)->first();
    
        return view('conducteur.profil')->with('matricule',$matricule)->with('conducteur',$conducteur);
    }
    public function updateprofil(Request $request)
    {
        $conducteur=conducteurs::find($request->CINC);
        $conducteur->CINC=$request->CINC;
        $conducteur->nom=$request->nom;
        $conducteur->prenom=$request->prenom;
        $conducteur->adresse=$request->adress;
        $conducteur->email=$request->email;
        $conducteur->date_naissance=$request->date_naissance;
        $conducteur->telephone=$request->telephone;
        // image de voiture
    if($request->file('photo')){
        //supprimer la photo
        $file_path=public_path().'/uploads/'.$conducteur->photo;
       // dd($file_path);
        if(unlink($file_path)){
        $rename = uniqid();
        $image = $request->file('photo');
        //dd($image);
        $rename .= "." . $image->getClientOriginalExtension();
        //dd($rename);
        $destinationPath = 'uploads';
        $image->move($destinationPath, $rename);
        $conducteur->photo = $rename;
        }
    }



    if($conducteur->update()){
        return back()->withErrors(['error' => 'le profile est modifier avec success.'])
        ->with('success','le profile est modifier avec success.');
  
    }



    }
}
