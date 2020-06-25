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

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

// Front area
Route::group(['namespace' => 'Front'], function () {

    // Kelas
    Route::get('/kelas/{kelas}/anggota', 'ClassroomController@anggota')->name('kelas.anggota');
    Route::get('/kelas/{kelas}/tambah-anggota', 'ClassroomController@tambahAnggota')->name('kelas.anggota.tambah');
    Route::get('/kelas/{kelas}/pelajaran', 'ClassroomController@pelajaran')->name('kelas.pelajaran');
    Route::get('/kelas/{kelas}/tambah-pelajaran', 'ClassroomController@tambahPelajaran')->name('kelas.pelajaran.tambah');
    Route::get('/kelas/{kelas}/ujian', 'ClassroomController@ujian')->name('kelas.ujian');
    Route::get('/kelas/{kelas}/beranda', 'ClassroomController@index')->name('kelas.beranda');
    Route::redirect('/kelas/{kelas}', '/kelas/{kelas}/beranda', 302);
});


// Admin area
Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin'
    ], function () {
        Route::get('/', 'AdminController@index')->name('admin.index');

        // Sections
        Route::get('/pelajaran/{lesson}/bab/create', 'SectionController@create')->name('lesson.section.create');
        Route::get('/pelajaran/{lesson}/bab/{section}', 'SectionController@show')->name('lesson.section.show');
        Route::post('/pelajaran/{lesson}/bab', 'SectionController@store')->name('lesson.section.store');

        // Lessons
        Route::get('/pelajaran/create', 'LessonController@create')->name('lesson.create');
        Route::get('/pelajaran/{lesson}', 'LessonController@show')->name('lesson.show'); 
        Route::get('/pelajaran', 'LessonController@index')->name('lesson.index');
        Route::post('/pelajaran', 'LessonController@store')->name('lesson.store');

        // Questions
        Route::get('/ujian/{exam}/soal/create', 'QuestionController@create')->name('exam.question.create');
        Route::get('/ujian/{exam}/soal/{soal}', 'QuestionController@show')->name('exam.question.show');
        Route::get('/ujian/{exam}/soal/lihat/{soal}', 'QuestionController@preview');
        Route::post('/ujian/{exam}/soal/unlink/', 'QuestionController@unlinkSoal')->name('exam.question.unlink');
        Route::post('/ujian/{exam}/soal', 'QuestionController@store')->name('exam.question.store');
        Route::put('/ujian/{exam}/soal', 'QuestionController@update')->name('exam.question.update');

        // Exams
        Route::get('/ujian', 'ExamController@index')->name('exam.index');
        Route::get('/ujian/create', 'ExamController@create')->name('exam.create');
        Route::get('/ujian/{exam}', 'ExamController@show')->name('exam.show');
        Route::post('/ujian', 'ExamController@store')->name('exam.store');

        // Users
        Route::get('/user/create', 'UserController@create')->name('user.create');
        Route::get('/user', 'UserController@index')->name('user.index');
        Route::post('/user', 'UserController@store')->name('user.store');

        // Classrooms
        Route::get('/kelas', 'ClassroomController@index')->name('classroom.index');
        Route::get('/grup/{grup}/kelas/create', 'ClassroomController@create')->name('group.classroom.create');
        Route::post('/grup/{grup}/kelas', 'ClassroomController@store')->name('group.classroom.store');
        Route::post('/kelas/{kelas}/assign-user/{user}', 'AssignUserController@store')->name('group.classroom.user.assign');
        Route::post('/kelas/{kelas}/anggota', 'AssignUserController@store')->name('group.classroom.user');

        // Groups
        Route::get('/grup', 'GroupController@index')->name('group.index');
        Route::get('/grup/create', 'GroupController@create')->name('group.create');
        Route::get('/grup/{grup}', 'GroupController@show')->name('group.show');
        Route::post('/grup', 'GroupController@store')->name('group.store');

    });

