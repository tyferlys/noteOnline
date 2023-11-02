<?php

use App\Http\Controllers\Auth\IndexAuthController;
use App\Http\Controllers\Auth\RegisterAuthController;
use App\Http\Controllers\Auth\OpenAuthController;
use App\Http\Controllers\Auth\StoreAuthController;
use App\Http\Controllers\Like\IndexLikeController;
use App\Http\Controllers\Main\Finders\FindNoteController;
use App\Http\Controllers\Main\Finders\FindPersonController;
use App\Http\Controllers\Main\IndexController;
use App\Http\Controllers\Note\DeleteNoteController;
use App\Http\Controllers\Note\IndexNoteController;
use App\Http\Controllers\Note\StoreNoteController;
use App\Http\Controllers\Note\UpdateNoteController;
use App\Http\Controllers\Note\ViewAllNote;
use App\Http\Controllers\Note\ViewAllNoteController;
use App\Http\Controllers\Note\ViewNoteController;
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

    Route::get("/createNote", IndexNoteController::class)->name("note.index");
    Route::get("/note/{noteId}", ViewNoteController::class)->name("note.view");
    Route::post("/createNote/{userId}", StoreNoteController::class)->name("note.store");
    Route::patch("/note/{noteId}", UpdateNoteController::class)->name("note.update");
    Route::delete("/note/{noteId}", DeleteNoteController::class)->name("note.delete");
    Route::get("/notes/{userId}", ViewAllNoteController::class)->name("note.view.all");
    Route::get("/notesAll", FindNoteController::class)->name("notesAll.view");

    Route::get("/like/{noteId}", IndexLikeController::class)->name("like.index");
});

Route::get("/login", IndexAuthController::class)->name("login.index");
Route::post("/login", OpenAuthController::class)->name("login.open");

Route::get("/registration", RegisterAuthController::class)->name("login.register");
Route::post("/registration", StoreAuthController::class)->name("login.store");

