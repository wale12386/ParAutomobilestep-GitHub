<?php

namespace App\Http\Controllers;

use App\Models\marques;
use App\Models\Modele;
use App\Models\voiture;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\conducteurs;
use App\Models\assurances;
use App\Models\taxes;
use App\Models\visiteTechnique;
use App\Models\Constat;
use App\Models\Deplacement;
use App\Models\echange;
use App\Models\Entretien;
use App\Models\Reparation;
use App\Models\vidange;
use App\Models\accidents;
use App\Models\affectationVoiture;
use Illuminate\Http\Request;

class VoitureController extends Controller
{
    public function index()
    {
        $voitures = voiture::with('marques','modele')
       // ->whereNotNull('archived_at')
       ->where('archived_at', null)
        ->get();
        $marques = marques::all();
        $modeles = Modele::all();
        
        
        return view('Admin.voitures.index',compact('voitures'))->with('modeles', $modeles)->with('marques', $marques);//->with('voitures', $voitures);
    }
    public function search(Request $request){
        $query = $request->get('query');
        $voitures = voiture::with('marques','modele')
        ->where('matricule',$query)
        ->where('archived_at', null)
         ->get();
         $marques = marques::all();
         $modeles = Modele::all();
         return view('Admin.voitures.index',compact('voitures'))->with('modeles', $modeles)->with('marques', $marques);//->with('voitures', $voitures);


    }
    public function formul()
    {
        $marques = marques::all();
        $modeles = Modele::all();
        //dd($modeles);
        return view('Admin.voitures.formul')->with('modeles', $modeles)->with('marques', $marques);
    }
    
    
    public function store(Request $request)
    {
       
         $request->validate(
             [
                 'matricule' => 'required|unique:voitures',
                 'photo' => 'required',
                 'couleur' => 'required',
                 'gps' => 'required',
                 'marque'=>'required',
                 'modele'=>'required',
                 'Date_1ere_cerculation'=>'required|date_format:Y-m-d',
                 
                 
             ]
         );
         $voiture = new voiture();
         $voiture->matricule = (string) $request->matricule; // cast input to string
         //$voiture->matricule = $request->matricule;
         $voiture->couleur = $request->couleur;
         $voiture->gps = $request->gps;
         $voiture->id_marque = $request->marque;
         $voiture->id_modele = $request->modele;
    

         $dateString = $request->Date_1ere_cerculation;
         $date = Carbon::parse($dateString)->format('Y-m-d');
         $voiture->Date_1ere_cerculation = $date;
         //dd($date);
         // image de voiture
         $rename = uniqid();
         $image = $request->file('photo');
         //dd($image);
         $rename .= "." . $image->getClientOriginalExtension();
         $destinationPath = 'uploads';
         $image->move($destinationPath, $rename);
         $voiture->photo = $rename;
         //end image voiture

         if($voiture->save()){
            $msg="L'ajout de voiture est fait avec success ";
            return redirect('/admin/voiture')
            ->withErrors(['error' => $msg])
                    ->with('success',$msg);
      
        }

     
    }
    
    



    public function archive($matricule)
{
   
    $voiture = Voiture::findOrFail($matricule);
    $voiture->archived_at = now();
    //archivage de tout les affectations corresponde au cette voiture
    DB::table('affectation_voitures')
    ->where('Matricule', '=', $matricule)
    ->update(['archived_at' => now()]);
   //archivage de tout les accidents corresponde au cette voiture
    DB::table('accidents')
    ->where('Matricule', '=', $matricule)
    ->update(['archived_at' => now()]);
    //archivage de tout les assurances corresponde au cette voiture
    DB::table('assurances')
    ->where('Matricule', '=', $matricule)
    ->update(['archived_at' => now()]);
    //archivage de tout les constats corresponde au cette voiture
    DB::table('constats')
    ->where('vehicule_id', '=', $matricule)
    ->update(['archived_at' => now()]);
    //archivage de tout les deplacements corresponde au cette voiture
         DB::table('deplacements')
         ->where('Matricule', '=', $matricule)
         ->update(['archived_at' => now()]);
    //archivage de tout les echanges corresponde au cette voiture
        DB::table('echanges')
        ->where('Matricule', '=', $matricule)
        ->update(['archived_at' => now()]);
    //archivage de tout les entretiens corresponde au cette voiture
        DB::table('entretiens')
        ->where('Matricule', '=', $matricule)
        ->update(['archived_at' => now()]);
    //archivage de tout les taxes corresponde au cette voiture
        DB::table('taxes')
        ->where('Matricule', '=', $matricule)
        ->update(['archived_at' => now()]);
    //archivage de tout les vidanges corresponde au cette voiture
        DB::table('vidanges')
        ->where('Matricule', '=', $matricule)
        ->update(['archived_at' => now()]);
    //archivage de tout les visites_techniques corresponde au cette voiture
        DB::table('visites_techniques')
        ->where('Matricule', '=', $matricule)
        ->update(['archived_at' => now()]);
    //destroy d'image
    //$fille_path=public_path().'/uploads/'.$voiture->photo;
    ///unlink($fille_path);
    //end destroy image
    if ($voiture->save()) {
        return redirect()->back();
    } else {
        echo 'Erreur';
    }
}
public function affecter($matricule){
    $affectation =  DB::table('affectation_voitures')
    ->where('Matricule', $matricule)
    ->where('archived_at', null)
    ->get();
    //dd($matricule);
    //dd($affectation);
    //$affectations =  DB::table('affectation_voitures')
    //->where('Matricule', $matricule)
   // ->whereNotNull('archived_at')
   // ->get();
   $conducteurs= DB::table('conducteurs')
   ->select('nom', 'prenom', 'CINC')
   ->whereNotIn('CINC', function ($query) {
       $query->select('CINC')
           ->from('affectation_voitures');
   })
   ->orWhere(function ($query) {
       $query->whereIn('CINC', function ($query) {
               $query->select('CINC')
                   ->from('conducteurs')
                   ->whereNull('archived_at');
           });
   })
   ->get();
   
     if($affectation->isEmpty())
    {
       //dd($affectations);
        return view('Admin.voitures.affectation.nonaffect')->with('matricule',$matricule)->with('conducteurs',$conducteurs);
    }
    else{
       
        //dd($conducteur);affectations
        return view('Admin.voitures.affectation.affect')->with('affectation',$affectation)->with('conducteurs',$conducteurs);

    }
}
public function update(Request $request)
{
   
    $voiture =  voiture::find((string) $request->matricule);
     // cast input to string
    //$voiture->matricule = $request->matricule;
    $voiture->couleur = $request->couleur;
    $voiture->gps = $request->gps;
    $voiture->id_marque = $request->marque;
    $voiture->id_modele = $request->modele;


    $dateString = $request->Date_1ere_cerculation;
    $date = Carbon::parse($dateString)->format('Y-m-d');
    $voiture->Date_1ere_cerculation = $date;
    //dd($date);
   
    // image de voiture
    if($request->file('photo')){
        //supprimer la photo
        $file_path=public_path().'/uploads/'.$voiture->photo;
        unlink($file_path);
        $rename = uniqid();
        $image = $request->file('photo');
        //dd($image);
        $rename .= "." . $image->getClientOriginalExtension();
        $destinationPath = 'uploads';
        $image->move($destinationPath, $rename);
        $voiture->photo = $rename;
    }
   
    //end image voiture

    if($voiture->update()){
       return redirect('/admin/voiture');
 
   }
}

public function statistiquearchive()
    {
        $datavoiture = [];

        for ($i = (Carbon::now()->year) - 5; $i < Carbon::now()->year; $i++) {
            $nbVoiture = DB::table('voitures')
                ->whereNotNull('archived_at')
                ->where(DB::raw('YEAR(created_at)'), $i)
                ->count();
        
            $datavoiture[$i] = $nbVoiture;
        }
        $dataaccident = [];

        for ($i = (Carbon::now()->year) - 5; $i < Carbon::now()->year; $i++) {
            $nbaccident = DB::table('accidents')
                ->whereNotNull('archived_at')
                ->where(DB::raw('YEAR(date_A)'), $i)
                ->count();
        
            $dataaccident[$i] = $nbaccident;
        }

        return view('Admin.voitures.archives', compact('datavoiture', 'dataaccident'));

    }

}
