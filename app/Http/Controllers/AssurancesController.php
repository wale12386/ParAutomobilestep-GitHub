<?php

namespace App\Http\Controllers;
use App\Models\assurances;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ConducteursController;

use Illuminate\Http\Request;
use Carbon\Carbon;
class AssurancesController extends Controller
{
    public function index()
    {
        $assurance = DB::table('assurances')
        ->where('archived_at', null)
        ->get();
       
        return view('Admin.assurance.index')->with('assurance', $assurance);
    }


    public function search(Request $request){
        $query = $request->get('query');
        $assurance = DB::table('assurances')
        ->where('archived_at', null)
        ->where('Matricule',$query)
        ->get();
        return view('Admin.assurance.index')->with('assurance', $assurance);

    }

    public function formul()
    {
        return view('Admin.assurance.formul');
    }
    
    public function formulconducteur($matricule)
    {
        return view('conducteur.assurance.formul')->with('matricule',$matricule);
    }
    
    public function storeconducteur(Request $request, $matricule)
    {
        $request->validate([
            'matricule' => 'required',
            'dateass' => 'required|date_format:Y-m-d',
            'contrat' => 'required'
        ]);
    
        $nbassure = DB::table('assurances')
            ->where('archived_at', null)
            ->where('Matricule', $request->matricule)
            ->count();
    
        if ($nbassure == 0) {
            $assurance = new assurances();
            $assurance->contratAssur = $request->contrat;
            $assurance->Matricule = $request->matricule;
            $dateAss = Carbon::createFromFormat('Y-m-d', $request->dateass)->format('Y-m-d');
            $assurance->dateAssur = $dateAss;
    
            if ($assurance->save()) {
                $msg= "L'assurance est ajouté avec success";
                return redirect()->route('conducteur.detail', ['matricule' => $matricule])
                    ->with('error',$msg)
                    ->with('success',$msg);
            }
        } else {
            return redirect()->route('conducteur.detail', ['matricule' => $matricule])
                ->with('error', 'Cette voiture est déjà en assurance')
                ->with('danger', 'Cette voiture est déjà en assurance');
        }
    }
    

    public function store(Request $request)
    {
        $request->validate(
            [
                'matricule' => 'required',
                
                'dateass' => 'required|date_format:Y-m-d',
                'contrat' => 'required'
            ]
        );
        $nbassure= DB::table('assurances')
        ->where('archived_at', null)
        ->where('Matricule',$request->matricule)
        ->count();

    if($nbassure==0)
    {
        $assurance = new assurances();
        // $voiture->matricule = (string) $request->matricule; // cast input to string
         //$voiture->matricule = $request->matricule;
         $assurance->contratAssur = $request->contrat;
         $assurance->Matricule = $request->matricule;
         $dateAss = Carbon::createFromFormat('Y-m-d', $request->dateass)->format('Y-m-d');
         $assurance->dateAssur = $dateAss;
 
 
         
 
 
         
         if ($assurance->save()) {
             $msg="L'assurance  est ajouté avec success ";
             return redirect('/admin/assurance')
             ->withErrors(['error' => $msg])
                     ->with('success',$msg);        }
    }else{
        return redirect('/admin/assurance')->with('error', 'Cette voiture est déjà en assurance') ->with('danger','Cette voiture est déjà en assurance');
    }
       
    }
    public function update(Request $request)
    {
        $id=$request->id;
        $assurance = assurances::find($id);
       // $voiture->matricule = (string) $request->matricule; // cast input to string
        //$voiture->matricule = $request->matricule;
        $assurance->contratAssur = $request->contrat;
        $assurance->Matricule = $request->matricule;
        $dateAss = Carbon::createFromFormat('Y-m-d', $request->dateass)->format('Y-m-d');
        $assurance->dateAssur = $dateAss;


        


        
        if ($assurance->update()) {
            $msg="L'assurance  est modifié avec success ";
            return redirect('/admin/assurance')
            ->withErrors(['error' => $msg])
                    ->with('success',$msg);
        }
    }
    public function archive($id)
    {
        $assurance = assurances::findOrFail($id);
        
          
        $assurance->archived_at = now();

   
        if($assurance->update())
        {
            return redirect()->back()->with('error', "l'assurance est archive avec success") ->with('success',"l'assurance est archive avec success");
        }

        
    }
}
