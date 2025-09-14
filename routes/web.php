<?php

use App\Http\Controllers\AuthManager;
use App\Http\Controllers\TaskManger;
use Illuminate\Support\Facades\Route;


// Login Route 
Route::get('login', [AuthManager::class,"login"])
    -> name("login");

// Login Post route
Route::post('login', [AuthManager::class,"loginPost"])
    ->name("login.post");

//Logout from the web
Route::get('logout', [AuthManager::class,"logout"])
    -> name("logout");

// Re Route 
Route::get('register', [AuthManager::class,"register"])
    -> name("register");

// Login Post route
Route::post('register', [AuthManager::class,"registerPost"])
    ->name("register.post");

Route::middleware("auth")->group(function () {
    
    Route::get('/',[TaskManger::class,"listTask"]) 
        ->name("home");
    
    Route::get("task/add", [TaskManger::class,"addTask"])
        ->name("task.add");
    
    Route::post("task/add", [TaskManger::class,"addTaskPost"])
        ->name("task.add.post");

    Route::get("task/status/{id}", [TaskManger::class,"updaTaskStatus"])
        ->name(name: "task.status.update");

    Route::get("task/delete/{id}", [TaskManger::class,"deleteTask"])
        ->name(name: "task.delete");

    Route::get("completed", [TaskManger::class,"completedTask"])
        ->name("completed");  
        
    // Route::post("task/update", [TaskManger::class,"updateTask"])
        // ->name("task.update");

    Route::get("task/edit/{id}", [TaskManger::class,"editTask"])
        ->name(name: "task.edit");

    Route::put("task/update/{id}", [TaskManger::class,"updateTask"])
        ->name("task.update");

});
