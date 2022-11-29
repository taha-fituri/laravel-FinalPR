<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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


Route::post('login', function (Request $request) {

    $r = $request->only('email', 'password');

    $logedin = Auth::guard()->attempt(
        $r
    );
    ///$user = User::query()->where('email', $email)->where('password', $pass)->exists();

    if ($logedin) {
        $token = $request->user()->createToken('react');
        return ['token' => $token->plainTextToken];
    }

    return abort(403);
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
