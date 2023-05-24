<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\assurances;

use App\Models\taxes;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function getNotificationsadmine()
    {
     //notification pour les assurances
     $today = Carbon::today();
     $assurances = DB::table('assurances')
     ->where('dateAssur', '>', $today)
     ->where('dateAssur', '<=', Carbon::today()->addDays(2))
     ->get();

     //notification pour les visites
     $visites = DB::table('visites_techniques')
     ->where('datev', '>', $today)
     ->where('datev', '<=', Carbon::today()->addDays(15))
     ->get();
//notification pour la modification de kilometrage
     $startOfWeek = $today->startOfWeek();
     $endOfWeek = $today->endOfWeek();
 
     $entretiens = DB::table('entretiens')
         ->select('matricule')
         ->whereBetween('dateE', [$startOfWeek, $endOfWeek])
         ->groupBy('matricule')
         ->get();


     //notification pour les taxes
 $taxes = DB::table('taxes')
     ->where('date_taxe', '>', $today)
     ->where('date_taxe', '<=', Carbon::today()->addDays(5))
    
     ->get();
     //notification de constat de tout les accidant 
     $accidents = DB::table('accidents')
     ->where('id_constat', null)
     ->where('date_A', '<=', $today)
     ->whereRaw('DATE_ADD(date_A, INTERVAL 5 DAY) >= CURDATE()')
     ->get();
     
     
     //notification  de vidange
     $vidanges = DB::table('entretiens')
     ->whereBetween('vidange', [9000, 10000])
//->groupBy('matricule')
     ->get();


 

 $notifications = [
     'assurances' => $assurances,
     'taxes' => $taxes,
     'visites'=>$visites,
     'entretiens'=>$entretiens,
     'accidents'=>$accidents,
     'vidanges'=>$vidanges    
 ];

    return response()->json($notifications);
    }
    public function getNotificationsconducteur($matricule)
    {
         //notification pour les assurances
     $today = Carbon::today();
     $assurances = DB::table('assurances')
     ->where('dateAssur', '>', $today)
     ->where('Matricule', $matricule)
     ->where('dateAssur', '<=', Carbon::today()->addDays(2))
     ->get();

     //notification pour les visites
     $visites = DB::table('visites_techniques')
     ->where('datev', '>', $today)
     ->where('Matricule', $matricule)
     ->where('datev', '<=', Carbon::today()->addDays(15))
     ->get();
//notification pour la modification de kilometrage
     $startOfWeek = $today->startOfWeek();
     $endOfWeek = $today->endOfWeek();
 
     $entretiens = DB::table('entretiens')
         ->select('matricule')
     ->where('Matricule', $matricule)
         ->whereBetween('dateE', [$startOfWeek, $endOfWeek])
         ->groupBy('matricule')
         ->get();


     //notification pour les taxes
 $taxes = DB::table('taxes')
     ->where('date_taxe', '>', $today)
     ->where('date_taxe', '<=', Carbon::today()->addDays(5))
    
     ->get();
     //notification de constat de tout les accidant 
     $accidents = DB::table('accidents')
     ->where('id_constat', null)
     ->where('Matricule', $matricule)
     ->where('date_A', '<=', $today)
     ->whereRaw('DATE_ADD(date_A, INTERVAL 5 DAY) >= CURDATE()')
     ->get();
     
     
     //notification  de vidange
     $vidanges = DB::table('entretiens')
     ->where('Matricule', $matricule)
     ->whereBetween('vidange', [9000, 10000])
//->groupBy('matricule')
     ->get();


 

 $notifications = [
     'assurances' => $assurances,
     'taxes' => $taxes,
     'visites'=>$visites,
     'entretiens'=>$entretiens,
     'accidents'=>$accidents,
     'vidanges'=>$vidanges    
 ];

    return response()->json($notifications);
    }
}
