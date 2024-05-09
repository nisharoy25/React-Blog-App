<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\TempImageControl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;


Route::get('blogs',[BlogController::class,'index']);
Route::post('blogs',[BlogController::class,'store']);
Route::post('save-temp-image',[TempImageControl::class,'store']);
Route::get('blogs/{id}',[BlogController::class,'show']);
// Route::put('blogs/{id}',[BlogController::class,'update']);
// Route::delete('blogs/{id}',[BlogController::class,'destroy']);
Route::get('categories', [CategoryController::class, 'fetchCategories']);



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  return $request->user();
});