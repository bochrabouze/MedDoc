<?php
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\PatientsController;
use App\Http\Controllers\API\VisitsController;
use App\Http\Controllers\API\PerspectionController;
use App\Http\Controllers\API\TestsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  //  return $request->user();
//});
Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);
Route::post('logout', [UserController::class, 'logout'])->middleware('auth:sanctum');

  Route::get('patients', [PatientsController::class,'index']);
  Route::post('patients/add', [PatientsController::class,'add']);
  Route::get('patients/edit/{id}', [PatientsController::class,'edit']);
  Route::post('patients/update/{id}', [PatientsController::class,'update']);
  Route::delete('patients/delete/{id}', [PatientsController::class,'delete']);

  Route::get('visits', [VisitsController::class,'index']);
  Route::post('visits/add', [VisitsController::class,'add']);
  Route::get('visits/edit/{id}', [VisitsController::class,'edit']);
  Route::post('visits/update/{id}', [VisitsController::class,'update']);
  Route::delete('visits/delete/{id}', [VisitsController::class,'delete']);

  Route::get('perspections', [PerspectionController::class,'index']);
  Route::post('perspections/add', [PerspectionController::class,'add']);
  Route::get('perspections/edit/{id}', [PerspectionController::class,'edit']);
  Route::post('perspections/update/{id}', [PerspectionController::class,'update']);
  Route::delete('perspections/delete/{id}', [PerspectionController::class,'delete']);

  Route::get('tests', [TestsController::class,'index']);
  Route::post('tests/add', [TestsController::class,'add']);
  Route::delete('tests/delete/{id}', [TestsController::class,'delete']);
 
