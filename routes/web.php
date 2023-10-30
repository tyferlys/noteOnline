<?php

use App\Http\Controllers\Auth\IndexAuthController;
use App\Http\Controllers\Auth\RegisterAuthController;
use App\Http\Controllers\Auth\OpenAuthController;
use App\Http\Controllers\Auth\StoreAuthController;
use App\Http\Controllers\Main\Finders\FindPersonController;
use App\Http\Controllers\Main\IndexController;
use App\Http\Controllers\Profile\ExitProfileController;
use App\Http\Controllers\Profile\IndexProfileController;
use App\Http\Controllers\Profile\UpdateProfileController;
use App\Http\Controllers\Profile\ViewProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware("auth")->group(function(){
    Route::get("/", IndexController::class)->name("main.index");
    Route::get("/findPerson/{login}/{name}/{surname}/{page}", FindPersonController::class)->name("main.findPerson");

    Route::get("/profile", IndexProfileController::class)->name("profile.index");
    Route::get("/profile/exit", ExitProfileController::class)->name("profile.exit");
    Route::patch("/profile", UpdateProfileController::class)->name("profile.update");

    Route::get("/profile/{login}", ViewProfileController::class)->name("profile.view");
});

Route::get("/login", IndexAuthController::class)->name("login.index");
Route::post("/login", OpenAuthController::class)->name("login.open");

Route::get("/registration", RegisterAuthController::class)->name("login.register");
Route::post("/registration", StoreAuthController::class)->name("login.store");

