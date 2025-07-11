<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EventController;

Route::get('/', [EventController::class, 'index']);

Route::get('/events/create', [EventController::class, 'create'])->middleware('auth');
Route::get('/events/{id}', [EventController::class, 'show']);
Route::get('/dashboard', [EventController::class, 'dashboard'])->middleware('auth');
Route::get('/events/edit/{id}', [EventController::class, 'edit'])->middleware('auth');
Route::delete('/events/{id}', [EventController::class, 'destroy'])->middleware('auth');
Route::put('/events/update/{id}', [EventController::class, 'update'])->middleware('auth');
Route::post('/event/join/{id}', [EventController::class, 'joinEvent'])->middleware('auth');
Route::post('/event/exit/{id}', [EventController::class, 'exitEvent'])->middleware('auth');
Route::post('/events', [EventController::class, 'store']);

/*Route::get('/contato', [Evepostontroller::class, 'contato']);


Route::get('/produtos',[EventController::class, 'produtos']);


Route::get('/produtos_teste/{id}', function ($id = null) {
    return view('product', ['id'=>$id]);
});


Route::get('/Array, Foreach', function () {
    
    $arr= [1,2,3,4,5];
    $nomes = ["Maria", "Joao", "Mateus", "Ana", "Pedro", "Jonas", "Carla", "Katia", "Marlene", "Ludmila", "Yola", "Sara"];

    return view('Array, Foreach', 
                    [
                        'arr' => $arr,
                        'nomes' => $nomes
                    ]);
});*/
