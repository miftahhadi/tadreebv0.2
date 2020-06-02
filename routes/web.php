<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Admin area
Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin'
    ], function () {
        Route::get('/', 'AdminController@index');

        // Sections
        Route::get('/pelajaran/{lesson}/bab/create', 'SectionController@create')->name('lesson.create_section');
        Route::get('/pelajaran/{lesson}/bab/{section}', 'SectionController@show');
        Route::post('/pelajaran/{lesson}/bab', 'SectionController@store');

        // Lessons
        Route::get('/pelajaran/create', 'LessonController@create')->name('create_lesson');
        Route::get('/pelajaran/{lesson}', 'LessonController@show'); 
        Route::get('/pelajaran', 'LessonController@index');
        Route::post('/pelajaran', 'LessonController@store');

        // Questions
        Route::get('/ujian/{exam}/soal/create', 'QuestionController@create');
        Route::post('/ujian/{exam}/soal', 'QuestionController@store');

        // Exams
        Route::get('/ujian', 'ExamController@index');
        Route::get('/ujian/create', 'ExamController@create')->name('create_exam');
        Route::post('/ujian', 'ExamController@store');
        Route::get('/ujian/{exam}', 'ExamController@show');

        // Users
        Route::get('/user/create', 'UserController@create');
        Route::get('/user', 'UserController@index');
        Route::post('/user', 'UserController@store');

        // Classrooms
        Route::get('/kelas/{kelas}/anggota', 'ClassroomController@anggota');
        Route::get('/kelas/{kelas}/pelajaran', 'ClassroomController@pelajaran');
        Route::get('/kelas/{kelas}', 'ClassroomController@show');
        Route::get('/kelas', 'ClassroomController@index');
        Route::get('/grup/{grup}/kelas/create', 'ClassroomController@create');
        Route::post('/grup/{grup}/kelas', 'ClassroomController@store');
        Route::post('/kelas/{kelas}/assign-user/{user}', 'AssignUserController@store');
        Route::post('/kelas/{kelas}/anggota', 'AssignUserController@store');

        // Groups
        Route::get('/grup', 'GroupController@index');
        Route::get('/grup/create', 'GroupController@create');
        Route::get('/grup/{grup}', 'GroupController@show');
        Route::post('/grup', 'GroupController@store');

    });

