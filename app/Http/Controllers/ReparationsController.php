<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reparation;
use Carbon\Carbon;
use App\Models\Fournisseur;

use Illuminate\Support\Facades\DB;

class ReparationsController extends Controller
{
    public function index()
    {
        $reparations = DB::table('reparations')
        ->where('archived_at', null)
        ->get();
       
        return view('Admin.reparation.index')->with('reparations', $reparations);
    }
    public function search(Request $request){
        $query = $request->get('query');
       
       
        $reparations = DB::table('reparations')
        ->where('archived_at', null)
        ->where('Matricule',$query)

        ->get();
       
        return view('Admin.reparation.index')->with('reparations', $reparations);

      
    }
    public function formul()
    {
        return view('Admin.reparation.formul');
    }
    public function store(Request $request)
    {
        $request->validate(
            [
                'matricule' => 'required',
                
                'date_R' => 'required|date_format:Y-m-d',
                'montant' => 'required',
                'degat' => 'required',
                'raison' => 'required',
                'adresse' => 'required',
                'telephonne' => 'required'



            ]
        );
        
        $fournisseurs=   DB::table('fournisseurs')
        ->where('raison',  $request->raison)
        ->where('adresse',  $request->adresse)
        ->where('téléphone',  $request->telephonne)
        ->get();
        if($fournisseurs->isEmpty()){
            $fournisseur=new Fournisseur();
            $fournisseur->raison=$request->raison;
           
            $fournisseur->adresse=$request->adresse;
           
            $fournisseur->téléphone=$request->telephonne;
            $fournisseur->save();
              
        

        }
        $idfor= DB::table('fournisseurs')
        ->where('raison', $request->raison)
        ->where('adresse', $request->adresse)
        ->where('téléphone', $request->telephonne)
        ->select('id_fournisseur')
        ->first();
        
       // dd($idfor);
        $reparation = new reparation();
       // $voiture->matricule = (string) $request->matricule; // cast input to string
        //$voiture->matricule = $request->matricule;
       // $reparation->dateR = $request->date_R;
        $dateAss = Carbon::createFromFormat('Y-m-d', $request->date_R)->format('Y-m-d');
        $reparation->dateR= $dateAss;
        $reparation->Matricule = $request->matricule;
        $reparation->montant = $request->montant;
        $reparation->dégât = $request->degat;

        $reparation->id_fournisseur = $idfor->id_fournisseur;
        //dd($vidange);



        


        
        if ($reparation->save()) {
            $msg="La reparation est ajouté avec success ";
            return redirect('/admin/reparation')
            ->withErrors(['error' => $msg])
                    ->with('success',$msg);
        }
    }


    public function formulconducteur($matricule)
    {
        return view('conducteur.reparation.formul')->with('matricule',$matricule);
    }
    public function storeconducteur(Request $request,$matricule)
    {
        $request->validate(
            [
                'matricule' => 'required',
                
                'date_R' => 'required|date_format:Y-m-d',
                'montant' => 'required',
                'degat' => 'required',
                'raison' => 'required',
                'adresse' => 'required',
                'telephonne' => 'required'



            ]
        );
        
        $fournisseurs=   DB::table('fournisseurs')
        ->where('raison',  $request->raison)
        ->where('adresse',  $request->adresse)
        ->where('téléphone',  $request->telephonne)
        ->get();
        if($fournisseurs->isEmpty()){
            $fournisseur=new Fournisseur();
            $fournisseur->raison=$request->raison;
           
            $fournisseur->adresse=$request->adresse;
           
            $fournisseur->téléphone=$request->telephonne;
            $fournisseur->save();
              
        

        }
        $idfor= DB::table('fournisseurs')
        ->where('raison', $request->raison)
        ->where('adresse', $request->adresse)
        ->where('téléphone', $request->telephonne)
        ->select('id_fournisseur')
        ->first();
        
       // dd($idfor);
        $reparation = new reparation();
       // $voiture->matricule = (string) $request->matricule; // cast input to string
        //$voiture->matricule = $request->matricule;
       // $reparation->dateR = $request->date_R;
        $dateAss = Carbon::createFromFormat('Y-m-d', $request->date_R)->format('Y-m-d');
        $reparation->dateR= $dateAss;
        $reparation->Matricule = $request->matricule;
        $reparation->montant = $request->montant;
        $reparation->dégât = $request->degat;

        $reparation->id_fournisseur = $idfor->id_fournisseur;
        //dd($vidange);



        


        
        if ($reparation->save()) {
            $msg="La reparation est ajouté avec success ";
            return redirect()->route('conducteur.detail', ['matricule' => $matricule])
            ->with('error',$msg)
            ->with('success',$msg);
        }
    }
}
