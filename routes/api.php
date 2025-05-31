<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/blogs', [BlogController::class, 'index']);
Route::get('/blog/{id}', [BlogController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
  Route::post('/blogs', [BlogController::class, 'store']); 
  Route::get('/my-blogs', [BlogController::class, 'myBlogs']);
  Route::get('/blog/edit/{id}', [BlogController::class, 'myBlogsEdit']);
  Route::delete('/blogs/{id}', [BlogController::class, 'destroy']);
  Route::put('/blogs/{id}', [BlogController::class, 'update']);
});

Route::get('/', function () {
  return response()->json(['message' => 'Welcome to the Blog API!']);
});