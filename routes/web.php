<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\KanbanController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\MachineController;
use App\Http\Controllers\MasterScheduleController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [AuthController::class, 'index'])->name('auth.index');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');


Route::middleware('auth')->group(function(){
    //Route User
    Route::prefix('user')->group(function(){
        Route::get('/', [UserController::class, 'index'])->name('user.index');
        Route::get('/tambah', [UserController::class, 'add'])->name('user.add');
        Route::post('/tambah', [UserController::class, 'create'])->name('user.create');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::post('/{id}/update', [UserController::class, 'update'])->name('user.update');
        Route::delete('/{id}/delete', [UserController::class, 'delete'])->name('user.delete');
    });
    //Route Mesin
    Route::prefix('mesin')->group(function(){
        Route::get('/', [MachineController::class, 'index'])->name('mesin.index');
        Route::get('/tambah', [MachineController::class, 'add'])->name('mesin.add');
        Route::post('/tambah', [MachineController::class, 'create'])->name('mesin.create');
        Route::get('/{id}/edit', [MachineController::class, 'edit'])->name('mesin.edit');
        Route::post('/{id}/update', [MachineController::class, 'update'])->name('mesin.update');
        Route::delete('/{id}/delete', [MachineController::class, 'delete'])->name('mesin.delete');
    });
    //Route Level
    Route::prefix('level')->group(function(){
        Route::get('/', [LevelController::class, 'index'])->name('level.index');
        Route::get('/tambah', [LevelController::class, 'add'])->name('level.add');
        Route::post('/tambah', [LevelController::class, 'create'])->name('level.create');
        Route::get('/{id}/edit', [LevelController::class, 'edit'])->name('level.edit');
        Route::post('/{id}/update', [LevelController::class, 'update'])->name('level.update');
        Route::delete('/{id}/delete', [LevelController::class, 'delete'])->name('level.delete');
    });
    //Route Shift
    Route::prefix('shift')->group(function(){
        Route::get('/', [ShiftController::class, 'index'])->name('shift.index');
        Route::get('/tambah', [ShiftController::class, 'add'])->name('shift.add');
        Route::post('/tambah', [ShiftController::class, 'create'])->name('shift.create');
        Route::get('/{id}/edit', [ShiftController::class, 'edit'])->name('shift.edit');
        Route::post('/{id}/update', [ShiftController::class, 'update'])->name('shift.update');
        Route::delete('/{id}/delete', [ShiftController::class, 'delete'])->name('shift.delete');
    });
    //Route Master Schedule
    Route::prefix('schedule')->group(function(){
        Route::get('/', [MasterScheduleController::class, 'index'])->name('schedule.index');
        Route::get('/tambah', [MasterScheduleController::class, 'add'])->name('schedule.add');
        Route::post('/tambah', [MasterScheduleController::class, 'create'])->name('schedule.create');
        Route::get('/{id}/edit', [MasterScheduleController::class, 'edit'])->name('schedule.edit');
        Route::post('/{id}/update', [MasterScheduleController::class, 'update'])->name('schedule.update');
        Route::delete('/{id}/delete', [ShiMasterScheduleControllerftController::class, 'delete'])->name('schedule.delete');
    });
    //Route Kanban
    Route::prefix('kanban')->group(function(){
        Route::get('/', [KanbanController::class, 'index'])->name('kanban.index');
        Route::get('/tambah', [KanbanController::class, 'add'])->name('kanban.add');
        Route::post('/tambah', [KanbanController::class, 'create'])->name('kanban.create');
        Route::get('/{id}/edit', [KanbanController::class, 'edit'])->name('kanban.edit');
        Route::post('/{id}/update', [KanbanController::class, 'update'])->name('kanban.update');
        Route::delete('/{id}/delete', [KanbanController::class, 'delete'])->name('kanban.delete');
    });
});