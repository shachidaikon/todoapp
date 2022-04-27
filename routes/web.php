<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\RoutineController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\MailSendController;


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/routines', [RoutineController::class, 'index']);
    Route::get('/routines/{routine}', [RoutineController::class, 'show']);
    Route::post('/routines', [RoutineController::class, 'store']);
    Route::put('/routines/{routine}', [RoutineController::class, 'update']);
    Route::delete('/routines/{routine}', [RoutineController::class, 'destroy']);

    //todo.indexのルーティングはroutineのshowメソッドで出す。から後々変更して
    Route::get('/', [TodoController::class, 'index'])->name('todo.index');
    Route::get('/todos/create', [TodoController::class, 'create'])->name('todo.create');
    Route::get('/todos/{todo}', [TodoController::class, 'show']);
    Route::get('/todos/{todo}/edit', [TodoController::class, 'edit']);
    Route::post('/todos', [TodoController::class, 'store']);
    Route::put('/todos/{todo}', [TodoController::class, 'update']);
    Route::put('/todos/{todo}/check', [TodoController::class, 'updateCheck']);
    Route::delete('/todos/{todo}', [TodoController::class, 'destroy']);
    

});

Route::get('/mail', [MailSendController::class, 'index']);
Route::post('/mail', [MailSendController::class, 'register']);

