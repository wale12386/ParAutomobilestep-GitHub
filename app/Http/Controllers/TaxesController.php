<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\taxes;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;


class TaxesController extends Controller
{
    public function index()
    {
        $taxes = DB::table('taxes')
        ->where('archived_at', null)
        ->get();
       
        return view('Admin.taxe.index')->with('taxes', $taxes);
    }

    public function search(Request $request){
        $query = $request->get('query');
        
        $taxes = DB::table('taxes')
        ->where('archived_at', null)
        ->where('Matricule',$query)

        ->get();
       
        return view('Admin.taxe.index')->with('taxes', $taxes);

      
    }




    public function formul()
    {
        return view('Admin.taxe.formul');
    }
  public function formulconducteur($matricule)
    {
        return view('conducteur.taxe.formul')->with('matricule',$matricule);
    }



    public function store(Request $request)
    {
        $request->validate(
            [
                'matricule'=>'required',
                'datetaxe'=>'required|date_format:Y-m-d'
            ]
        );
        $nbtaxe=DB::table('taxes')
        ->where('archived_at', null)
       // ->where('Matricule',$matricule)
        ->count();
        
        if ($nbtaxe == 0) {
            $taxe=new taxes();
            $taxe->Matricule=$request->matricule;
            $dateAss = Carbon::createFromFormat('Y-m-d', $request->datetaxe)->format('Y-m-d');
            $taxe->date_taxe= $dateAss;
    
            $taxe->date_taxe=$request->datetaxe;
            if ($taxe->save()) {
                $msg="Le taxe est ajouté avec success ";
                return redirect('/admin/taxe')
                ->withErrors(['error' => $msg])
                        ->with('success',$msg);
            }
          
        } else {
            return redirect('/admin/assurance')->with('error', 'Cette voiture est déjà en taxe') ->with('danger','Cette voiture est déjà en taxe');

        }
    }

    public function storeconducteur(Request $request,$matricule)
    {
        $request->validate(
            [
                'matricule'=>'required',
                'datetaxe'=>'required|date_format:Y-m-d'
            ]
        );
        $nbtaxe=DB::table('taxes')
        ->where('archived_at', null)
        ->where('Matricule',$matricule)
        ->count();
        
        if ($nbtaxe == 0) {
            $taxe=new taxes();
            $taxe->Matricule=$request->matricule;
            $dateAss = Carbon::createFromFormat('Y-m-d', $request->datetaxe)->format('Y-m-d');
            $taxe->date_taxe= $dateAss;
    
            $taxe->date_taxe=$request->datetaxe;
            if ($taxe->save()) {
                $msg="Le taxe est ajouté avec success ";
                return redirect()->route('conducteur.detail', ['matricule' => $matricule])
                ->with('error',$msg)
                ->with('success',$msg);
            }
          
        } else {
            return redirect()->route('conducteur.detail', ['matricule' => $matricule])
                ->with('error', 'Cette voiture est déjà en taxe')
                ->with('danger', 'Cette voiture est déjà en taxe');
        }
    }

    public function archive($id)
    {
        $taxe = taxes::findOrFail($id);
        
          
        $taxe->archived_at = now();
   
        if($taxe->update())
        {
            return redirect()->back()->with('error', "le taxe est archive avec success") ->with('success',"le taxe est archive avec success");
        }

        
    }

     
    

}
