<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Constat;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use function Ramsey\Uuid\v1;

class ConstatController extends Controller
{
    public function index()
    {
        $constats =DB::table('constats')
        ->where('archived_at', null)
        ->get();

 
       
        return view('Admin.constat.index')->with('constats', $constats);
    }
    public function search(Request $request){
        $query = $request->get('query');
        
        $constats =DB::table('constats')        
         ->where('archived_at', null)
        ->where('vehicule_id',$query)

        ->get();
       
        return view('Admin.constat.index')->with('constats', $constats);

      
    }
    public function formul()
    {
        return view('Admin.constat.formul');
    }
    public function formulconducteur($matricule)
    {
        return view('conducteur.constat.formul')->with('matricule',$matricule);
    }
    public function store(Request $request)
    {
        $request->validate(
            [
                'matricule' => 'required',
                
                'lieu' => 'required',
                'matriculev' => 'required',
                'assurancev' => 'required',
                'date_c' => 'required|date_format:Y-m-d',


            ]
        );
        $constat = new constat();
       // $voiture->matricule = (string) $request->matricule; // cast input to string
        //$voiture->matricule = $request->matricule;
        $constat->lieu_c = $request->lieu;
        $constat->matriculev = $request->matriculev;
        $constat->assurancev = $request->assurancev;
        $constat->vehicule_id = $request->matricule;
        $date_c = Carbon::createFromFormat('Y-m-d', $request->date_c)->format('Y-m-d');
        $constat->date_c = $date_c;


        


        
        if ($constat->save()) {
            $msg="Le constat  est ajouté avec success ";
            return redirect('/admin/constat')
            ->withErrors(['error' => $msg])
                    ->with('success',$msg);
        }
    }
    public function storeconducteur(Request $request,$matricule)
    {
        $request->validate(
            [
                'matricule' => 'required',
                
                'lieu' => 'required',
                'matriculev' => 'required',
                'assurancev' => 'required',
                'date_c' => 'required|date_format:Y-m-d',


            ]
        );
        $constat = new constat();
       // $voiture->matricule = (string) $request->matricule; // cast input to string
        //$voiture->matricule = $request->matricule;
        $constat->lieu_c = $request->lieu;
        $constat->matriculev = $request->matriculev;
        $constat->assurancev = $request->assurancev;
        $constat->vehicule_id = $request->matricule;
        $date_c = Carbon::createFromFormat('Y-m-d', $request->date_c)->format('Y-m-d');
        $constat->date_c = $date_c;


        


        
        if ($constat->save()) {
            $msg="Le constat  est ajouté avec success ";
            return redirect()->route('conducteur.detail', ['matricule' => $matricule])
            ->with('error', $msg)
            ->with('success', $msg);
        }
    }
    

}
