<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\vidange;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use App\Models\Fournisseur;
class VidangesController extends Controller
{
    public function index()
    {
        $vidanges = DB::table('vidanges')
        ->where('archived_at', null)
        ->get();

       
        return view('Admin.vidange.index')->with('vidanges', $vidanges);
    }

    public function search(Request $request){
        $query = $request->get('query');
        $vidanges = DB::table('vidanges')
        ->where('archived_at', null)
        ->where('Matricule',$query)

        ->get();
        return view('Admin.vidange.index')->with('vidanges', $vidanges);

      
    }
    public function formul()
    {
        return view('Admin.vidange.formul');
    }
    public function store(Request $request)
    {
        $request->validate(
            [
                'matricule' => 'required',
                
                'kilometrage' => 'required',
                'montant' => 'required',
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
        $vidange = new vidange();
       // $voiture->matricule = (string) $request->matricule; // cast input to string
        //$voiture->matricule = $request->matricule;
        $vidange->kilométrage = $request->kilometrage;
        $vidange->Matricule = $request->matricule;
        $vidange->montant = $request->montant;
        $vidange->id_fournisseur = $idfor->id_fournisseur;
        //dd($vidange);



        


        
        if ($vidange->save()) {
            $msg="Le vidange est ajouté avec success ";
            return redirect('/admin/vidange')
            ->withErrors(['error' => $msg])
                    ->with('success',$msg);
        }
    }

    public function formulconducteur($matricule)
    {
        return view('conducteur.vidange.formul')->with('matricule',$matricule);
    }
    public function storeconducteur(Request $request,$matricule)
    {
        $request->validate(
            [
                'matricule' => 'required',
                
                'kilometrage' => 'required',
                'montant' => 'required',
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
        $vidange = new vidange();
       // $voiture->matricule = (string) $request->matricule; // cast input to string
        //$voiture->matricule = $request->matricule;
        $vidange->kilométrage = $request->kilometrage;
        $vidange->Matricule = $request->matricule;
        $vidange->montant = $request->montant;
        $vidange->id_fournisseur = $idfor->id_fournisseur;
        //dd($vidange);



        


        
        if ($vidange->save()) {
            $msg="Le vidange est ajouté avec success ";
            return redirect()->route('conducteur.detail', ['matricule' => $matricule])
                    ->with('error',$msg)
                    ->with('success',$msg);
        }
    }
}
