<?php

use App\Http\Controllers\TasksController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\TasksxUserController;






/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// ADMIN
Route::get('/home', [AdminController::class, 'index'])->name('home');


// LOGIN
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

//USUARIOS
Route::get('/users', [UserController::class, 'index'])->name('user')->middleware('checkRole:1');
Route::post('/user', [UserController::class, 'store'])->name('crearUser');
Route::get('usuarios/{user}/editar', [UserController::class, 'edit'])->name('usuario.editar');
Route::put('usuarios/{user}', [UserController::class, 'update'])->name('usuario.actualizar');
Route::delete('/usuario/eliminar/{usuario}', [UserController::class, 'destroy'])->name('usuario.eliminar');

// TASKS
Route::post('/task', [TasksController::class, 'store'])->name('crearTask');
Route::get('/tareas', [TasksController::class, 'index'])->name('tareas')->middleware('checkRole:1');
Route::get('tareas/{tareas}/editar', [TasksController::class, 'edit'])->name('tareas.editar');
Route::put('tareas/{tareas}', [TasksController::class, 'update'])->name('tareas.actualizar');
Route::delete('/tarea/eliminar/{tarea}', [TasksController::class, 'destroy'])->name('tareas.eliminar');
Route::get('/tareasxUsuario', [TasksxUserController::class, 'mostrarTareas'])->name('taskxUser');

