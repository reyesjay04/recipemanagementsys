<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataTableAjaxCRUDController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('ajax-crud-datatable', [DataTableAjaxCRUDController::class, 'index']);
Route::post('store-recipe', [DataTableAjaxCRUDController::class, 'store']);
Route::post('edit-recipe', [DataTableAjaxCRUDController::class, 'edit']);
Route::post('delete-recipe', [DataTableAjaxCRUDController::class, 'destroy']);
Route::post('update-recipe', [DataTableAjaxCRUDController::class, 'update']);
