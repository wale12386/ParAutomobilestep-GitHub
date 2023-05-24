<?php

namespace App\Http\Controllers;

use App\Models\marques;
use Illuminate\Http\Request;

class MarquesController extends Controller
{
    public function index()
    {
        $marques = marques::all();
       
        return view('Admin.marque.index')->with('marques', $marques);
    }

    public function search(Request $request){
        $query = $request->get('query');
       
       
        
        $marques = marques::where('libellemarque', $query)->get();


       
        return view('Admin.marque.index')->with('marques', $marques);

      
    } 

    public function formul()
    {
        return view('Admin.marque.formul');
    }
    public function store(Request $request)
    {
        $request->validate(
            [
                'libellemarque' => 'required|unique:marques,libellemarque'
                ]
            );
            $marque=new marques();
        $marque->libellemarque=$request->libellemarque;
        
        $marque->save();
        $msg="La marque est ajouté avec success ";
        return redirect('/admin/marque')
        ->withErrors(['error' => $msg])
                ->with('success',$msg);    }
    public function update(Request $request)
    {
       
        $id=$request->id;
        $marque = marques::find($id);
        $marque->libellemarque=$request->libellemarque;
        
       if($marque->save()) {
        $msg="La marque est modifier avec success ";
        return redirect('/admin/marque')
        ->withErrors(['error' => $msg])
                ->with('success',$msg);
       }
       
  
    }
   
}

