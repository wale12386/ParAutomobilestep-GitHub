<?php

namespace App\Http\Controllers;

use App\Models\Modele;
use App\Models\marques;
use Illuminate\Http\Request;

class ModelesController extends Controller
{ public function index()
    {
        $modeles = Modele::with('marques')->get();
        $marques = marques::all();
        return view('Admin.modele.index',compact('modeles'))->with('marques', $marques);
    }

    public function search(Request $request){
        $query = $request->get('query');
       
       
        $modeles = Modele::with('marques')
        ->where('libellemodele',$query)
        ->get();
        $marques = marques::all();
        return view('Admin.modele.index',compact('modeles'))->with('marques', $marques);

      
    } 

    public function formul()
    {
        $marques = marques::all();
        return view('Admin.modele.formul', compact('marques'));

    }
    public function store(Request $request)
    {
        $request->validate(
            [
                'libellemodele'=>'required',
                'marque'=>'required',
                
            ]
        );
        $modele=new Modele();
        $modele->libellemodele=$request->libellemodele;
        $matchingMarque = marques::where('libellemarque', $request->marque)->first();
        $modele->id_marque=$matchingMarque->idmarque;
        if($modele->save()){
            $msg="Le modele est ajouté avec success ";
            return redirect('/admin/modele')
            ->withErrors(['error' => $msg])
                    ->with('success',$msg);
      
        }
    }
    public function update(Request $request)
    {
        
        $id=$request->id;
        $modele = Modele::find($id);
        $modele->libellemodele=$request->libellemodele;
        $matchingMarque = marques::where('libellemarque', $request->marque)->first();
        $modele->id_marque=$matchingMarque->idmarque;
        if($modele->save()){
            $msg="Le modele est modifier avec success ";
            return redirect('/admin/modele')
            ->withErrors(['error' => $msg])
                    ->with('success',$msg);
      
        }
    }
    
}
