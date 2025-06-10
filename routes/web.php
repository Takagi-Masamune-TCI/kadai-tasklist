<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TaskController;

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

// トップページはタスクリストの「一覧」と同じページにルーティングする設定を入れる
Route::get('/', [TaskController::class, 'index']);

// タスクを管理するRouterには Route::resource を利用する
Route::resource('tasks', TaskController::class);