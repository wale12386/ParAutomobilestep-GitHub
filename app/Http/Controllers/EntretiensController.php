<?php

namespace App\Http\Controllers;

use App\Models\Entretien;
use App\Models\voiture;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class EntretiensController extends Controller
{
    public function index()
    {
        $entretiens = DB::table('entretiens')
        ->where('archived_at', null)
        ->get();
       
        return view('Admin.entretien.index')->with('entretiens', $entretiens);
    }


    public function search(Request $request){
        $query = $request->get('query');
        
        $entretiens = DB::table('entretiens')
                ->where('archived_at', null)
        ->where('Matricule',$query)

        ->get();
       
        return view('Admin.entretien.index')->with('entretiens', $entretiens);

      
    } 
    public function formul()
    {
        $voitures=voiture::all();
        return view('Admin.entretien.formul')->with('voitures',$voitures);
    }
    public function store(Request $request)
    {
        $request->validate(
            [
                'matricule'=>'required',
                'dateE'=>'required|date_format:Y-m-d',
                'kilométrage'=>'required'
                
            ]
        );
        $nbentr= DB::table('entretiens')
        ->where('archived_at', null)
        ->where('Matricule',$request->matricule)
        ->count();

    if($nbentr==0){
        $entretien=new Entretien();
        $entretien->Matricule=$request->matricule;
      

        $dateString = $request->dateE;
        $date = Carbon::parse($dateString)->format('Y-m-d');
        $entretien->dateE = $date;

        $entretien->kilométrage=$request->kilométrage;
        
      
      // dd($entretien);
       if($entretien->save()){
        $msg="L'entretien est ajouté avec success ";
        return redirect('/admin/entretien')
        ->withErrors(['error' => $msg])
                ->with('success',$msg);


    }
       
  
    }else{
        return redirect('/admin/entretien')->with('error', 'Cette voiture est déjà en entretien') ->with('danger','Cette voiture est déjà en entretien');
    }
    }

    public function formulconducteur($matricule)
    {
        $voitures=voiture::all();
        return view('conducteur.entretien.formul')->with('voitures',$voitures)->with('matricule',$matricule);
    }
    public function storeconducteur(Request $request,$matricule)
    {
        $request->validate(
            [
                'matricule'=>'required',
                'dateE'=>'required|date_format:Y-m-d',
                'kilométrage'=>'required'
                
            ]
        );
        $entretien=new Entretien();
        $entretien->Matricule=$request->matricule;
      

        $dateString = $request->dateE;
        $date = Carbon::parse($dateString)->format('Y-m-d');
        $entretien->dateE = $date;

        $entretien->kilométrage=$request->kilométrage;
        
      
      // dd($entretien);
       if($entretien->save()){
        $msg= "L'entretien est ajouté avec success";

        return redirect()->route('conducteur.detail', ['matricule' => $matricule])
        ->with('error',$msg)
        ->with('success',$msg);

  
    }
    }
    public function update(Request $request)
    {
        $id=$request->id;
        $entretien=Entretien::find($id);
        $entretien->vidange+=$request->kilométrage- $entretien->kilométrage;
        $entretien->Matricule=$request->matricule;
      

        $dateString = $request->dateE;
        $date = Carbon::parse($dateString)->format('Y-m-d');
        $entretien->dateE = $date;

        $entretien->kilométrage=$request->kilométrage;
        
      
      // dd($entretien);
       if($entretien->update()){
        return redirect('/admin/entretien');
  
    }
    }
    public function archive($id)
    {
        $entretien = Entretien::findOrFail($id);
        
          
        $entretien->archived_at = now();

   
        if($entretien->update())
        {
            return redirect()->back()->with('error', "l'entretien est archive avec success") ->with('success',"l'entretien est archive avec success");
        }

        
    }
}
