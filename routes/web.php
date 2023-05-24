<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\NotificationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/loginn', [App\Http\Controllers\user::class, 'login']);
Route::get('/loginn',[App\Http\Controllers\user::class, 'viewlogin']);

Route::get('/login/forgotpassword',[App\Http\Controllers\Auth\LoginController::class, 'forgot_password']);
Route::post('/login/forgotpassword',[App\Http\Controllers\Auth\LoginController::class, 'forgot_password']);
Route::get('/login/changePassword/{tocken}',[App\Http\Controllers\Auth\LoginController::class, 'changePasswordview']);
Route::post('/login/changePassword',[App\Http\Controllers\Auth\LoginController::class, 'changePassword']);

Route::get('/admin/dashbord',[App\Http\Controllers\AdminController::class, 'dashbord'])->name('dashbord.search');


Route::get('/conducteur/dashbord',[App\Http\Controllers\ConducteursController::class, 'dashbord']);
Route::get('/conducteur/dashbord/{matricule}',[App\Http\Controllers\ConducteursController::class, 'dashbord2']);

Route::get('/conducteur/detail/{matricule}',[App\Http\Controllers\ConducteursController::class, 'detail'])->name('conducteur.detail');
Route::get('/conducteur/profil/{matricule}',[App\Http\Controllers\ConducteursController::class, 'profil']);
Route::post('/conducteur/profil/update',[App\Http\Controllers\ConducteursController::class, 'updateprofil']);



Route::post('/admin/condicteur/password/update',[App\Http\Controllers\ConducteursController::class, 'updatepassword']);
Route::get('/admin/conducteur/{CINC}/delete',[App\Http\Controllers\ConducteursController::class, 'archive']);


Route::get('/admin/voiture',[App\Http\Controllers\VoitureController::class, 'index']);
Route::get('/admin/voiture/archive',[App\Http\Controllers\VoitureController::class, 'statistiquearchive']);
Route::post('/voiture/search',[App\Http\Controllers\VoitureController::class, 'search'])->name('voiture.search');

Route::get('/admin/voiture/add',[App\Http\Controllers\VoitureController::class, 'formul']);
Route::post('/admin/voiture/add',[App\Http\Controllers\VoitureController::class, 'store']);
Route::post('/admin/voiture/update',[App\Http\Controllers\VoitureController::class, 'update']);

Route::get('/admin/voiture/{matricule}/delete',[App\Http\Controllers\VoitureController::class, 'archive']);


Route::get('/admin/assurance',[App\Http\Controllers\assurancesController::class, 'index']);
Route::post('/admin/assurance/search',[App\Http\Controllers\assurancesController::class, 'search'])->name('assurance.search');

Route::get('/admin/assurance/add',[App\Http\Controllers\assurancesController::class, 'formul']);
Route::get('/conducteur/assurance/add/{matricule}',[App\Http\Controllers\assurancesController::class, 'formulconducteur']);
Route::post('/conducteur/assurance/add/{matricule}',[App\Http\Controllers\assurancesController::class, 'storeconducteur']);
Route::get('/admin/assurance/{matricule}/delete',[App\Http\Controllers\assurancesController::class, 'archive']);


Route::post('/admin/assurance/add',[App\Http\Controllers\assurancesController::class, 'store']);
Route::post('/admin/assurance/update',[App\Http\Controllers\assurancesController::class, 'update']);

Route::get('/admin/marque',[App\Http\Controllers\marquesController::class, 'index']);
Route::get('/admin/marque/add',[App\Http\Controllers\marquesController::class, 'formul']);
Route::post('/admin/marque/add',[App\Http\Controllers\marquesController::class, 'store']);
Route::post('/admin/marque/update',[App\Http\Controllers\marquesController::class, 'update']);
Route::post('/admin/marque/search',[App\Http\Controllers\marquesController::class, 'search'])->name('marque.search');

Route::post('/admin/taxe/search',[App\Http\Controllers\taxesController::class, 'search'])->name('taxe.search');

Route::get('/admin/taxe',[App\Http\Controllers\taxesController::class, 'index']);
Route::get('/admin/taxe/add',[App\Http\Controllers\taxesController::class, 'formul']);
Route::post('/admin/taxe/add',[App\Http\Controllers\taxesController::class, 'store']);
Route::get('/admin/taxe/{matricule}/delete',[App\Http\Controllers\taxesController::class, 'archive']);

Route::get('/conducteur/taxe/add/{matricule}',[App\Http\Controllers\taxesController::class, 'formulconducteur']);
Route::post('/conducteur/taxe/add/{matricule}',[App\Http\Controllers\taxesController::class, 'storeconducteur']);

Route::get('/admin/modele',[App\Http\Controllers\ModelesController::class, 'index']);
Route::post('/admin/modele/search',[App\Http\Controllers\ModelesController::class, 'search'])->name('modele.search');

Route::get('/admin/modele/add',[App\Http\Controllers\modelesController::class, 'formul']);
Route::post('/admin/modele/add',[App\Http\Controllers\modelesController::class, 'store']);


Route::post('/admin/modele/update',[App\Http\Controllers\modelesController::class, 'update']);

Route::get('/admin/visite',[App\Http\Controllers\visitesTechniqueController::class, 'index']);
Route::get('/admin/visite/{matricule}/delete',[App\Http\Controllers\visitesTechniqueController::class, 'archive']);

Route::get('/admin/visite/add',[App\Http\Controllers\visitesTechniqueController::class, 'formul']);
Route::post('/admin/visite/add',[App\Http\Controllers\visitesTechniqueController::class, 'store']);
Route::get('/conducteur/visite/add/{matricule}',[App\Http\Controllers\visitesTechniqueController::class, 'formulconducteur']);
Route::post('/conducteur/visite/add/{matricule}',[App\Http\Controllers\visitesTechniqueController::class, 'storeconducteur']);
Route::post('/admin/visite/update',[App\Http\Controllers\visitesTechniqueController::class, 'update']);
Route::post('/admin/visite/search',[App\Http\Controllers\visitesTechniqueController::class, 'search'])->name('visite.search');


Route::post('/admin/entretien/search',[App\Http\Controllers\entretiensController::class, 'search'])->name('entretien.search');

Route::get('/admin/entretien',[App\Http\Controllers\entretiensController::class, 'index']);
Route::get('/admin/entretien/{matricule}/delete',[App\Http\Controllers\entretiensController::class, 'archive']);

Route::get('/admin/entretien/add',[App\Http\Controllers\entretiensController::class, 'formul']);
Route::post('/admin/entretien/add',[App\Http\Controllers\entretiensController::class, 'store']);

Route::get('/conducteur/entretien/add/{matricule}',[App\Http\Controllers\entretiensController::class, 'formulconducteur']);
Route::post('/conducteur/entretien/add/{matricule}',[App\Http\Controllers\entretiensController::class, 'storeconducteur']);
Route::post('/admin/entretien/update',[App\Http\Controllers\entretiensController::class, 'update']);


Route::get('/admin/conducteur',[App\Http\Controllers\ConducteursController::class, 'index']);
Route::get('/admin/conducteur/add',[App\Http\Controllers\conducteursController::class, 'formul']);
Route::post('/admin/conducteur/add',[App\Http\Controllers\conducteursController::class, 'store']);

Route::post('/admin/conducteur/search',[App\Http\Controllers\conducteursController::class, 'search'])->name('conducteur.search');


Route::get('/admin/vidange',[App\Http\Controllers\vidangesController::class, 'index']);
Route::get('/admin/vidange/add',[App\Http\Controllers\vidangesController::class, 'formul']);
Route::post('/admin/vidange/add',[App\Http\Controllers\vidangesController::class, 'store']);
Route::get('/conducteur/vidange/add/{matricule}',[App\Http\Controllers\vidangesController::class, 'formulconducteur']);
Route::post('/conducteur/vidange/add/{matricule}',[App\Http\Controllers\vidangesController::class, 'storeconducteur']);
Route::post('/admin/vidange/search',[App\Http\Controllers\vidangesController::class, 'search'])->name('vidange.search');



Route::get('/admin/accident',[App\Http\Controllers\accidentsController::class, 'index']);
Route::get('/admin/accident/add',[App\Http\Controllers\accidentsController::class, 'formul']);
Route::post('/admin/accident/add',[App\Http\Controllers\accidentsController::class, 'store']);
Route::get('/conducteur/accident/add{matricule}',[App\Http\Controllers\accidentsController::class, 'formulconducteur']);
Route::post('/conducteur/accident/add{matricule}',[App\Http\Controllers\accidentsController::class, 'storeconducteur']);
Route::post('/admin/accident/update',[App\Http\Controllers\accidentsController::class, 'update']);
Route::post('/admin/accident/search',[App\Http\Controllers\accidentsController::class, 'search'])->name('accident.search');


Route::get('/admin/reparation',[App\Http\Controllers\reparationsController::class, 'index']);
Route::get('/admin/reparation/add',[App\Http\Controllers\reparationsController::class, 'formul']);
Route::post('/admin/reparation/add',[App\Http\Controllers\reparationsController::class, 'store']);

Route::get('/conducteur/reparation/add/{matricule}',[App\Http\Controllers\reparationsController::class, 'formulconducteur']);
Route::post('/conducteur/reparation/add/{matricule}',[App\Http\Controllers\reparationsController::class, 'storeconducteur']);
Route::post('/admin/reparation/search',[App\Http\Controllers\reparationsController::class, 'search'])->name('reparation.search');


Route::get('/admin/echange',[App\Http\Controllers\echangesController::class, 'index']);
Route::get('/admin/echange/add',[App\Http\Controllers\echangesController::class, 'formul']);
Route::post('/conducteur/echange/add/{matricule}',[App\Http\Controllers\echangesController::class, 'storeconducteur']);
Route::get('/conducteur/echange/add/{matricule}',[App\Http\Controllers\echangesController::class, 'formulconducteur']);
Route::post('/admin/echange/add',[App\Http\Controllers\echangesController::class, 'store']);
Route::post('/admin/echange/search',[App\Http\Controllers\echangesController::class, 'search'])->name('echange.search');



Route::get('/admin/constat',[App\Http\Controllers\constatController::class, 'index']);
Route::get('/admin/constat/add',[App\Http\Controllers\constatController::class, 'formul']);
Route::post('/admin/constat/add',[App\Http\Controllers\constatController::class, 'store']);
Route::get('/conducteur/constat/add/{matricule}',[App\Http\Controllers\constatController::class, 'formulconducteur']);
Route::post('/conducteur/constat/add/{matricule}',[App\Http\Controllers\constatController::class, 'storeconducteur']);
Route::post('/admin/constat/search',[App\Http\Controllers\constatController::class, 'search'])->name('constat.search');

Route::get('/admin/fournisseur',[App\Http\Controllers\FournisseursController::class, 'index']);
Route::get('/admin/fournisseur/add',[App\Http\Controllers\FournisseursController::class, 'formul']);
Route::post('/admin/fournisseur/add',[App\Http\Controllers\FournisseursController::class, 'store']);
Route::post('/admin/fournisseur/search',[App\Http\Controllers\FournisseursController::class, 'search'])->name('fournisseur.search');


Route::get('/admin/deplacement',[App\Http\Controllers\DeplacementController::class, 'index']);
Route::get('/admin/deplacement/add',[App\Http\Controllers\DeplacementController::class, 'formul']);
Route::post('/admin/deplacement/add',[App\Http\Controllers\DeplacementController::class, 'store']);

Route::get('/conducteur/deplacement/add/{matricule}',[App\Http\Controllers\DeplacementController::class, 'formulconducteur']);
Route::post('/conducteur/deplacement/add/{matricule}',[App\Http\Controllers\DeplacementController::class, 'storeconducteur']);
Route::post('/admin/deplacement/search',[App\Http\Controllers\DeplacementController::class, 'search'])->name('deplacement.search');



Route::get('/admin/voiture/{matricule}/affecter',[App\Http\Controllers\VoitureController::class, 'affecter']);
Route::post('/admin/affectation/add',[App\Http\Controllers\AffectationVoitureController::class, 'affecter']);
Route::post('/admin/affectation/search',[App\Http\Controllers\AffectationVoitureController::class, 'search'])->name('affectation.search');

Route::post('/admin/affectation/update',[App\Http\Controllers\AffectationVoitureController::class, 'update']);
Route::get('/admin/affectation/{CINC}/archive',[App\Http\Controllers\AffectationVoitureController::class, 'archive']);
Route::get('/admin/affectation',[App\Http\Controllers\AffectationVoitureController::class, 'index']);




Route::get('/notify', [HomeController::class, 'notify']);

Route::get('/test',[NotificationController::class, 'getNotificationsadmine']);
Route::get('/test/{matricule}',[NotificationController::class, 'getNotificationsconducteur']);


Route::get('/testing',function(Request $request){
    return view('');
});