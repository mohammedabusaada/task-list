<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function(){
    $name = "Mohammed";
    $departments = [
        '1' => 'Technical',
        '2' => 'Financial',
        '3' => 'Sales'
    ];
    // return view('about', ['name' => $name]);
    // return view('about') -> with('name', $name);
    return view('about', compact('name', 'departments'));
});


Route::post('/about', function(){
    $name = $_POST['name'];
    $departments = [
        '1' => 'Technical',
        '2' => 'Financial',
        '3' => 'Sales'
    ];
    return view('about', compact('name', 'departments'));
});


// Tasks Routs
Route::get('tasks', [TaskController::class, 'index']);
Route::post('tasks/create', [TaskController::class, 'create']);
Route::post('delete/{id}', [TaskController::class, 'destroy']);
Route::post('edit/{id}', [TaskController::class, 'edit']);
Route::post('update', [TaskController::class, 'update']);


// Users Routes
Route::get('/users', [UserController::class, 'index']);
Route::post('/users/addUser', [UserController::class, 'addUser']);
Route::get('/users/edit/{id}', [UserController::class, 'edit']);
Route::post('/users/update/{id}', [UserController::class, 'update']);
Route::delete('/users/delete/{id}', [UserController::class, 'destroy']);


Route::get('app', function(){
    return view('layouts\app');
});