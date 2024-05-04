<?php

use App\Http\Resources\ExamResource;
use App\Http\Resources\QuestionResource;
use App\Models\Oex_category;
use App\Models\Oex_exam_master;
use App\Models\Oex_question_master;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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

Route::get('/exams', function () {
    return new ExamResource(Oex_exam_master::with(['cate' => function ($query) {
        $query->select("id", "name");
    }])->get()->toArray());
});

Route::get('/categories', function () {
    return new ExamResource(Oex_category::all());
});

Route::get('/questions/{exam_id}', function ($exam_id) {
    return new QuestionResource(Oex_question_master::where('exam_id',$exam_id)->get()->toArray());
});

Route::get('/run-exam-seed/{cate_id}', [AdminController::class, 'seed_exam']);