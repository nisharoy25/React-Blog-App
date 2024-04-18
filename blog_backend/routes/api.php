<?php

use App\Http\Controllers\BlogController;
use Illuminate\Http\Request;
use Illuminate\Support\Route;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  return $request->user();
});



Route::post('blogs', [BlogController::class,'store']);

Route::post('blogs', [BlogController::class,'index']);