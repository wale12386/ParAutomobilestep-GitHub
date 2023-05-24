<?php

namespace App\Http\Controllers;

use App\Models\Fournisseur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FournisseursController extends Controller
{
    public function index()
    {
        $fournisseurs = DB::table('fournisseurs')
        ->where('archived_at', null)
        ->get();
       
        return view('Admin.fournisseur.index')->with('fournisseurs', $fournisseurs);
    }

    public function search(Request $request){
        $query = $request->get('query');
       
       
        $fournisseurs = DB::table('fournisseurs')
        ->where('archived_at', null)
        ->where('raison',$query)

        ->get();
       
        return view('Admin.fournisseur.index')->with('fournisseurs', $fournisseurs);

      
    }
    public function formul()
    {
        return view('Admin.fournisseur.formul');
    }
    public function store(Request $request)
    {
        $request->validate(
            [
                'raison'=>'required',
                'adresse'=>'required',
                'telephone'=>'required',

            ]
        );
        $fournisseurs=   DB::table('fournisseurs')
        ->where('raison',  $request->raison)
        ->where('adresse',  $request->adresse)
        ->where('téléphone',  $request->telephone)
        ->get();
        if($fournisseurs->isEmpty()){
            $fournisseur=new Fournisseur();
            $fournisseur->raison=$request->raison;
           
            $fournisseur->adresse=$request->adresse;
           
            $fournisseur->téléphone=$request->telephone;
           if( $fournisseur->save()){
            $msg="Le fournisseur est ajouté avec success ";
            return redirect('/admin/fournisseur')
            ->withErrors(['error' => $msg])
                    ->with('success',$msg);

           }
              
        

        }else{
            $msg="cette fournisseur est existe déja ";
            return redirect('/admin/fournisseur')
            ->withErrors(['error' => $msg])
                    ->with('success',$msg);

        }
        
            
        
    }
}
