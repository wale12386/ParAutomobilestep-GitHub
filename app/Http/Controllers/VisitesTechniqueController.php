<?php

namespace App\Http\Controllers;

use App\Models\visiteTechnique;
use Illuminate\Http\Request;
use App\Models\voiture;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class VisitesTechniqueController extends Controller
{
    public function index()
    {
        $visites = DB::table('visites_techniques')
        ->where('archived_at',null)
        ->get();
                $voitures=voiture::all();
        return view('Admin.visite_tech.index')->with('visites',$visites)->with('voitures',$voitures);
    }

    public function search(Request $request){
        $query = $request->get('query');
        $visites = DB::table('visites_techniques')
        ->where('Matricule',$query)
        ->where('archived_at',null)
        ->get();
        $voitures=voiture::all();
        return view('Admin.visite_tech.index')->with('visites',$visites)->with('voitures',$voitures);
    }
   
   
    public function formul()
    {
        $voitures=voiture::all();
        return view('Admin.visite_tech.formul')->with('voitures',$voitures);
    }

    public function formulconducteur($matricule)
    {
       
        return view('conducteur.visite_tech.formul')->with('matricule',$matricule);
    }
   
   
   
    public function store(Request $request)
    {
        $request->validate(
            [
                'matricule'=>'required',
                'datev'=>'required|date_format:Y-m-d',
                'resultatv'=>'required',
                'description'=>'nullable'
                
            ]
        );
        $nbvisite= DB::table('visites_techniques')
        ->where('Matricule',$request->matricule)
        ->where('archived_at',null)
        ->count();
        
     if($nbvisite==0)
        {
            $visite=new visiteTechnique();
            $visite->Matricule=$request->matricule;
            //$visite->datev=$request->datev;

            $dateString = $request->datev;
            $date = Carbon::parse($dateString)->format('Y-m-d');
            $visite->datev = $date;

            $visite->resultatv=$request->resultatv;
            if($request->description!=' Si la visite non accepter donne une description ....'){
                
                $visite->description=$request->description;

            }
        
        //dd($visite);
        if($visite->save()){
            
            $msg="La visite technique est ajouté avec success ";
            return redirect('/admin/visite')
            ->withErrors(['error' => $msg])
                    ->with('success',$msg);
    
        }
        }else{
            return redirect('/admin/visite')->with('error', 'Cette voiture est déjà en visite') ->with('danger','Cette voiture est déjà en visite');
        }
       
    }

     
    public function storeconducteur(Request $request,$matricule)
    {
        $request->validate(
            [
                'matricule'=>'required',
                'datev'=>'required|date_format:Y-m-d',
                'resultatv'=>'required',
                'description'=>'nullable'
                
            ]
        );
        $nbvisite= DB::table('visites_techniques')
        ->where('Matricule',$matricule)
        ->where('archived_at',null)
        ->count();
        
     if($nbvisite==0)
        {
            $visite=new visiteTechnique();
            $visite->Matricule=$request->matricule;
            //$visite->datev=$request->datev;

            $dateString = $request->datev;
            $date = Carbon::parse($dateString)->format('Y-m-d');
            $visite->datev = $date;

            $visite->resultatv=$request->resultatv;
            if($request->description!=' Si la visite non accepter donne une description ....'){
                
                $visite->description=$request->description;

            }
        
        //dd($visite);
        if($visite->save()){
            
            $msg="La visite technique est ajouté avec success ";
            return redirect()->route('conducteur.detail', ['matricule' => $matricule])
            ->with('error',$msg)
            ->with('success',$msg);
    
        }
        }else{
            return redirect()->route('conducteur.detail', ['matricule' => $matricule])
            ->with('error', 'Cette voiture est déjà en assurance')
            ->with('danger', 'Cette voiture est déjà en assurance');
        }
               
    }
    
    public function update(Request $request)
    {
      
        $id=$request->id;
    $visite = visiteTechnique::find($id);
        $visite->Matricule=$request->matricule;
        //$visite->datev=$request->datev;

        $dateString = $request->datev;
        $date = Carbon::parse($dateString)->format('Y-m-d');
        $visite->datev = $date;

        $visite->resultatv=$request->resultatv;
        if($request->description!=' Si la visite non accepter donne une description ....'){
            
            $visite->description=$request->description;

        }
      
       //dd($visite);
       if($visite->update()){
        return redirect('/admin/visite');
  
    }
    }
    public function archive($id)
    {
        $visite = visiteTechnique::findOrFail($id);
        
          
        $visite->archived_at = now();
   
        if($visite->update())
        {
            return redirect()->back()->with('error', "la visite est archive avec success") ->with('success',"la visite est archive avec success");
        }

        
    }
}
