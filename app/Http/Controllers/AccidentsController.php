<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\accidents;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class AccidentsController extends Controller
{
    
    
    public function index()
    {
        $accidents = DB::table('accidents')
        ->where('archived_at', null)
        ->get();
      // dd($accidents);
        return view('Admin.accident.index')->with('accidents', $accidents);
    }

    public function search(Request $request){
       // $query=$request->query;
        $query = $request->get('query');

        $accidents = DB::table('accidents')
        ->where('archived_at', null)
        ->where('Matricule',$query)
        ->get();
        return view('Admin.accident.index')->with('accidents', $accidents);

    }
    public function formulconducteur($matricule)
    {
        $constat = DB::table('constats')
        ->where('archived_at', null)
        ->where('vehicule_id',$matricule)
        ->get();
       
        return view('conducteur.accident.formul')->with('constat', $constat)->with('matricule',$matricule);
    }
    public function formul()
    {
        $constat = DB::table('constats')
        ->where('archived_at', null)
        ->get();
       
        return view('Admin.accident.formul')->with('constat', $constat);
    }
    public function storeconducteur(Request $request,$matricule)
    {
        $request->validate(
            [
                'matricule' => 'required',
                
                'date_A' => 'required|date_format:Y-m-d',
                'assurance' => 'nullable',

                
            ]
        );
      
        $accidant = new accidents();
       // $voiture->matricule = (string) $request->matricule; // cast input to string
        //$voiture->matricule = $request->matricule;
     
       



        $accidant->Matricule = $request->matricule;
        $date_A = Carbon::createFromFormat('Y-m-d', $request->date_A)->format('Y-m-d');
        $accidant->date_A = $date_A;
        if ($request->assurance != '') {
            $id = DB::table('constats')
                ->where('assurancev', $request->assurance)
                ->where('archived_at', null)
                ->select('id_constat')
                ->first();
        
            if ($id !== null && isset($id->id_constat)) {
                $accidant->id_constat = $id->id_constat;
            } else {
                return redirect()->back()->with('error', "N'existe pas un constat avec cette assurance")
                    ->with('danger', "N'existe pas un constat avec cette assurance");
            }
        }
        
        


        
        if ($accidant->save()) {
            $msg="L'accidant  est ajouté avec success ";
            return redirect()->route('conducteur.detail', ['matricule' => $matricule])
            ->with('error', $msg)
            ->with('success', $msg);
        }
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'matricule' => 'required',
                
                'date_A' => 'required|date_format:Y-m-d',
                'assurance' => 'nullable',

                
            ]
        );
    
            $accidant = new accidents();
            // $voiture->matricule = (string) $request->matricule; // cast input to string
             //$voiture->matricule = $request->matricule;
          
            
     
     
     
             $accidant->Matricule = $request->matricule;
             $date_A = Carbon::createFromFormat('Y-m-d', $request->date_A)->format('Y-m-d');
             $accidant->date_A = $date_A;
             if ($request->assurance != '') {
                $id = DB::table('constats')
                    ->where('assurancev', $request->assurance)
                    ->where('archived_at', null)
                    ->select('id_constat')
                    ->first();
            
                if ($id !== null && isset($id->id_constat)) {
                    $accidant->id_constat = $id->id_constat;
                } else {
                    return redirect()->back()->with('error', "N'existe pas un constat avec cette assurance")
                        ->with('danger', "N'existe pas un constat avec cette assurance");
                }
            }
     
             
             if ($accidant->save()) {
                 $msg="L'accidant  est ajouté avec success ";
                 return redirect('/admin/accident')
                 ->withErrors(['error' => $msg])
                         ->with('success',$msg);
            

        }
      
    }
    public function update(Request $request)
    {
        $id=$request->id;
        $accidant = accidents::find($id);
       // $voiture->matricule = (string) $request->matricule; // cast input to string
        //$voiture->matricule = $request->matricule;
        $accidant->Matricule = $request->matricule;
        $date_A = Carbon::createFromFormat('Y-m-d', $request->date_A)->format('Y-m-d');
        $accidant->date_A = $date_A;
        
        if($request->assurance!=''){
            $id= DB::table('constats')
            ->where('assurancev',$request->assurance )
            ->where('archived_at', null)
            ->select('id_constat')
            ->first();
           
        $accidant->id_constat = $id->id_constat;
       }



        


        
        if ($accidant->update()) {
            return redirect('/admin/accident');
        }
    }
}
