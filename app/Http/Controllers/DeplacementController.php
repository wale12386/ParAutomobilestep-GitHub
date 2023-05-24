<?php

namespace App\Http\Controllers;
use App\Models\Deplacement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeplacementController extends Controller
{
    public function index()
    {
        $deplacements = DB::table('deplacements')
        ->where('archived_at', null)
        ->get();
       
        return view('Admin.deplacement.index')->with('deplacements', $deplacements);
    }

    public function search(Request $request){
        $query = $request->get('query');
        
        $deplacements = DB::table('deplacements')
         ->where('archived_at', null)
        ->where('Matricule',$query)

        ->get();
       
        return view('Admin.deplacement.index')->with('deplacements', $deplacements);

      
    } 
    public function formul()
    {
        $conducteurs = DB::table('conducteurs')
        ->where('archived_at', null)
        ->get();
        return view('Admin.deplacement.formul')->with('conducteurs', $conducteurs);
    }
    public function store(Request $request)
    {
        $request->validate(
            [
                'matricule'=>'required',
                'CINC'=>'required',
                'destination'=>'required',
                'kilometrage'=>'required',
                'qte_carburant'=>'required'



            ]
        );
        $deplacement=new deplacement();
        $deplacement->Matricule=$request->matricule;
        $deplacement->kilometrage=$request->kilometrage;
        $deplacement->qte_carburant=$request->qte_carburant;
        $deplacement->CINC=$request->CINC;
        $deplacement->destination=$request->destination;
        if ($deplacement->save()) {
            $msg="La deplacement  est ajouté avec success ";
            return redirect('/admin/deplacement')
            ->withErrors(['error' => $msg])
                    ->with('success',$msg);
    
        }
    }


    public function formulconducteur($matricule)
    {
        $conducteurs = DB::table('conducteurs')
        ->where('archived_at', null)
        ->get();
        return view('conducteur.deplacement.formul')->with('conducteurs', $conducteurs)->with('matricule',$matricule);
    }
    public function storeconducteur(Request $request,$matricule)
    {
        $request->validate(
            [
                'matricule'=>'required',
                'CINC'=>'required',
                'destination'=>'required',
                'kilometrage'=>'required',
                'qte_carburant'=>'required'



            ]
        );
        $deplacement=new deplacement();
        $deplacement->Matricule=$request->matricule;
        $deplacement->kilometrage=$request->kilometrage;
        $deplacement->qte_carburant=$request->qte_carburant;
        $deplacement->CINC=$request->CINC;
        $deplacement->destination=$request->destination;
        if ($deplacement->save()) {
            $msg="La deplacement  est ajouté avec success ";
            return redirect()->route('conducteur.detail', ['matricule' => $matricule])
            ->with('error',$msg)
            ->with('success',$msg);
    
        }
    }
}
