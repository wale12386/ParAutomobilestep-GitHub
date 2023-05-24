<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\echange;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class EchangesController extends Controller
{
    public function index()
    {
        $echanges = DB::table('echanges')
        ->where('archived_at', null)
        ->get();
       // dd($echanges);
       
        return view('Admin.echange.index')->with('echanges', $echanges);
    }

    public function search(Request $request){
        $query = $request->get('query');
        
        $echanges = DB::table('echanges')               
         ->where('archived_at', null)
        ->where('Matricule',$query)

        ->get();
       
        return view('Admin.echange.index')->with('echanges', $echanges);

      
    } 
    public function formul()
    {
        $conducteurs=DB::table('conducteurs')
        ->where('archived_at', null)
        ->get();
        
        return view('Admin.echange.formul')->with('conducteurs',$conducteurs);
    }
    public function store(Request $request)
    {
        $request->validate(
            [
                'matricule' => 'required',
                
                'dateEch' => 'required|date_format:Y-m-d',
                'kilometrage' => 'required',
                'etat'=> 'required',
               
                'niveaucarburant'=> 'required',
                'conducteur1'=> 'required',
                'conducteur2'=> 'required'
            ]
        );
        $echange = new echange();
       // $voiture->matricule = (string) $request->matricule; // cast input to string
        //$voiture->matricule = $request->matricule;
        $echange->kilometrage = $request->kilometrage;
        $echange->Niveaucarburant = $request->niveaucarburant;
        $echange->conducteur1 = $request->conducteur1;
        $echange->conducteur2 = $request->conducteur2;
        $echange->accidentelle = $request->etat;



        $echange->Matricule = $request->matricule;
        $dateEch = Carbon::createFromFormat('Y-m-d', $request->dateEch)->format('Y-m-d');
        $echange->dateEch = $dateEch;


        


        
        if ($echange->save()) {
            $msg="L'echange  est ajouté avec success ";
            return redirect('/admin/echange')
            ->withErrors(['error' => $msg])
                    ->with('success',$msg);
    
        }
    }
    public function formulconducteur($matricule)
    {
        $conducteurs=DB::table('conducteurs')
        ->where('archived_at', null)
        ->get();
        
        return view('conducteur.echange.formul')->with('conducteurs',$conducteurs)->with('matricule',$matricule);
    }
    public function storeconducteur(Request $request,$matricule)
    {
        $request->validate(
            [
                'matricule' => 'required',
                
                'dateEch' => 'required|date_format:Y-m-d',
                'kilometrage' => 'required',
                'etat'=> 'required',
               
                'niveaucarburant'=> 'required',
                'conducteur1'=> 'required',
                'conducteur2'=> 'required'
            ]
        );
        $echange = new echange();
       // $voiture->matricule = (string) $request->matricule; // cast input to string
        //$voiture->matricule = $request->matricule;
        $echange->kilometrage = $request->kilometrage;
        $echange->Niveaucarburant = $request->niveaucarburant;
        $echange->conducteur1 = $request->conducteur1;
        $echange->conducteur2 = $request->conducteur2;
        $echange->accidentelle = $request->etat;



        $echange->Matricule = $request->matricule;
        $dateEch = Carbon::createFromFormat('Y-m-d', $request->dateEch)->format('Y-m-d');
        $echange->dateEch = $dateEch;


        


        
        if ($echange->save()) {
            $msg="L'echange  est ajouté avec success ";
         
            
            return redirect()->route('conducteur.detail', ['matricule' => $matricule])
            ->with('error',$msg)
            ->with('success',$msg);
    
        }
    }
}
