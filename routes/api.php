<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\User;
use Illuminate\Support\Facades\Hash;

use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;

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
Route::post('/get_token', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'device_name' => 'required'
    ]);
 
    $user = User::where('email', $request->email)->first();
 
    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }
 
    return $user->createToken($request->device_name)->plainTextToken;
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:sanctum')->get('/get_all', 'TaskController@getAll');
Route::middleware('auth:sanctum')->get('/change_status', 'TaskController@changeStatus');
Route::middleware('auth:sanctum')->post('/create', 'TaskController@create');

Route::post('/file/add', 'BookController@add');

Route::get('/file/all', 'FileController@all');

Route::get('/file/delete/{id}', 'BookController@delete');