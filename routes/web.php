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

Auth::routes(['register' => false]);

Route::get('/logout', 'Auth\LogoutController@logout')->name('logout');

// Front area
Route::group([
    'namespace' => 'Front',
    'middleware' => 'auth'
    ], function () {

    // Beranda    
    Route::get('/', 'FrontController@index')->name('main.index');

    // Kelas
    Route::get('/kelas/{kelas}/anggota', 'ClassroomController@anggota')->name('kelas.anggota');
    Route::get('/kelas/{kelas}/tambah-anggota', 'ClassroomController@tambahAnggota')->name('kelas.anggota.tambah')->middleware('admin');

    Route::get('/kelas/{kelas}/pelajaran', 'ClassroomController@pelajaran')->name('kelas.pelajaran');
    Route::get('/kelas/{kelas}/tambah-pelajaran', 'ClassroomController@tambahPelajaran')->name('kelas.pelajaran.tambah')->middleware('admin');
    
    Route::get('/kelas/{kelas}/ujian', 'ClassroomController@ujian')->name('kelas.ujian');
    Route::get('/kelas/{kelas}/tambah-ujian', 'ClassroomController@tambahUjian')->name('kelas.ujian.tambah')->middleware('admin');
    Route::get('/kelas/{kelas}/ujian/{ujian}/setting', 'ClassroomController@settingUjian')->name('kelas.ujian.setting')->middleware('admin');
    Route::post('/kelas/{kelas}/ujian/{ujian}/save-setting', 'ClassroomController@saveSettingUjian')->name('kelas.ujian.saveSetting')->middleware('admin');
    Route::post('/kelas/{kelas}/assign-ujian', 'ClassroomController@tambahUjianBulk')->name('kelas.ujian.assign')->middleware('admin');
    
    Route::get('/kelas/{kelas}/beranda', 'ClassroomController@index')->name('kelas.beranda');
    Route::redirect('/kelas/{kelas}', '/kelas/{kelas}/beranda', 302);

    // Kerjain ujian
    Route::get('/k/{kelas}/u/{slug}', 'ExamController@info')->name('ujian.info');
    Route::get('/k/{kelas}/u/{slug}/init', 'ExamController@init')->name('ujian.init');
    Route::get('k/{kelas}/u/{slug}/soal/{soal}', 'ExamController@kerjain')->name('ujian.kerjain');
    Route::get('/submitted', 'ExamController@submitted')->name('ujian.submitted');
    Route::post('k/{kelas}/u/{slug}/soal/{soal}', 'ExamController@storeJawaban')->name('ujian.storeJawaban');

    // Hasil ujian
    Route::get('/k/{kelas}/u/{slug}/hasil/', 'HasilController@showAll')->name('ujian.hasil.showAll');
    Route::get('/k/{kelas}/u/{slug}/hasil/selesai', 'HasilController@showDone')->name('ujian.hasil.showDone');

    // Detail nilai ujian
    Route::get('/k/{kelas}/u/{slug}/detail/{user}', 'HasilController@detail')->name('ujian.hasil.detail');

    Route::get('/denied', 'TolakController@index')->name('denied');
});


// Admin area
Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'middleware' => ['admin', 'auth']
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
        Route::put('/ujian/{exam}', 'ExamController@update')->name('exam.update'); 
        Route::get('/ujian', 'ExamController@index')->name('exam.index');
        Route::get('/ujian/create', 'ExamController@create')->name('exam.create');
        Route::get('/ujian/{exam}', 'ExamController@show')->name('exam.show');
        Route::get('/ujian/{exam}/edit', 'ExamController@edit')->name('exam.edit');
        Route::post('/ujian', 'ExamController@store')->name('exam.store');
        

        // Users
        Route::get('/user/create', 'UserController@create')->name('user.create');
        Route::get('/user/{user}/edit', 'UserController@edit')->name('user.edit');
        Route::put('/user/{user}', 'UserController@update')->name('user.update');
        Route::get('/user', 'UserController@index')->name('user.index');
        Route::get('/user/import-csv', 'UserController@getCsv')->name('user.getCsv');
        Route::post('/user/parse-csv', 'UserController@parseCsv')->name('user.parseCsv');
        Route::post('/user/proses-import', 'UserController@processImport')->name('user.processImport');
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

