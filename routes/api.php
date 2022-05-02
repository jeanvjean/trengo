<?php
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CategoriesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/posts', [PostsController::class, 'index']);

Route::post('/posts', [PostsController::class, 'store']);

Route::patch('/posts', [PostsController::class, 'update']);

Route::get('/view-post/{id}', [PostsController::class, 'show']);

Route::get('/like-rate/post/{id}', [PostsController::class, 'like']);

Route::post('/create-category', [CategoriesController::class, 'store']);

Route::get('/fetch-categories', [CategoriesController::class, 'index']);