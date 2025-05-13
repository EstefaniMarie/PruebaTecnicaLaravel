<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\Api\TaskApiController;
use App\Http\Resources\UserResource;
use App\Http\Resources\TaskResource;
use App\Models\User;
use App\Models\Task;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::middleware(['throttle:api'])->group(function () {
    Route::get('/test', function () {
        return response()->json(['message' => 'Todo bien']);
    });

    Route::apiResource('users', UserApiController::class);
    Route::apiResource('tareas', TaskApiController::class);
});

Route::get('/test-users', function () {
    $users = User::all();
    return UserResource::collection($users);
});


Route::get('/test-tasks', function () {
    $tareas = Task::all();
    return TaskResource::collection($tareas);
});