<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\SettingUjianService;
use App\Services\SaveSettingUjianService;
use Carbon\Carbon;
use App\Classroom;
use App\Group;
use App\User;
use App\Exam;

class ClassroomController extends Controller
{
    public function index(Classroom $kelas)
    {

        return view('front.classroom.index', [
            'title' => 'Beranda | ' . $kelas->nama, 
            'kelas' => $kelas
        ]);
    }

    public function anggota(Classroom $kelas)
    {
        $users = $kelas->users->all();

        return view('front.classroom.anggota', [
            'title' => 'Anggota | ' . $kelas->nama,
            'kelas' => $kelas,
            'users' => $users,
        ]);
    }

    public function tambahAnggota(Classroom $kelas)
    {
        $users = User::all();

        $assigned = [];

        foreach ($users as $user) {
            $assigned[$user->id] = $kelas->users->contains($user->id);
        }

        return view('front.classroom.tambah-anggota', [
            'title' => 'Tambah Anggota | ' . $kelas->nama,
            'kelas' => $kelas,
            'users' => $users,
            'assigned' => $assigned
        ]);

    }

    public function pelajaran(Classroom $kelas)
    {
        return view('front.classroom.pelajaran',[
            'title' => 'Pelajaran | ' . $kelas->nama,
            'kelas' => $kelas
        ]);
    }

    public function tambahPelajaran(Classroom $kelas)
    {
        $lessons = \App\Lesson::all();

        return view('front.classroom.tambah-pelajaran',[
            'title' => 'Tambah Pelajaran | ' . $kelas->nama,
            'kelas' => $kelas,
            'lessons' => $lessons
        ]);
    }

    public function tambahUjian(Classroom $kelas)
    {
        $exams = Exam::all();

        return view('front.classroom.tambah-ujian',[
            'title' => 'Tambah Ujian | ' . $kelas->nama,
            'kelas' => $kelas,
            'exams' => $exams
        ]);
    }

    public function tambahUjianBulk(Classroom $kelas, Request $request)
    {
        foreach ($request->ujianId as $ujianId) {
            $kelas->exams()->attach($ujianId);
        }

        return redirect(route('kelas.ujian', ['kelas' => $kelas]));
    }

    public function ujian(Classroom $kelas)
    {

        return view('front.classroom.ujian', [
            'title' => 'Ujian | ' . $kelas->nama,
            'kelas' => $kelas,
            'exams' => $kelas->exams
        ]);
    }

    public function settingUjian(Classroom $kelas, Exam $ujian)
    {
        // Cek setting sebelumnya
        $ujian = $kelas->exams()->find($ujian->id);

        $tampil_otomatis = SettingUjianService::bongkarWaktu($ujian->pivot->tampil_otomatis);

        $buka_otomatis = SettingUjianService::bongkarWaktu($ujian->pivot->buka_otomatis);

        $batas_buka = SettingUjianService::bongkarWaktu($ujian->pivot->batas_buka);

        return view('front.classroom.setting-ujian', [
            'title' => 'Pengaturan Ujian | ' . $ujian->judul . ' | ' . $kelas->nama,
            'kelas' => $kelas,
            'ujian' => $ujian,
            'tampil_otomatis' => $tampil_otomatis ?? '',
            'buka_otomatis' => $buka_otomatis ?? '',
            'batas_buka' => $batas_buka ?? ''
        ]);
    }

    public function saveSettingUjian(Classroom $kelas, Exam $ujian, Request $request)
    {
        
        $setting = new SaveSettingUjianService();

        $tampil_otomatis = $setting->setWaktu($request->tampil_otomatis['tanggal'], $request->tampil_otomatis['waktu']);

        $buka_otomatis = $setting->setWaktu($request->buka_otomatis['tanggal'], $request->buka_otomatis['waktu']);

        $batas_buka = $setting->setWaktu($request->batas_buka['tanggal'], $request->batas_buka['waktu']);

        $kelas->exams()->updateExistingPivot($ujian->id, [
            'tampil' => $request->tampil,
            'buka' => $request->buka,
            'buka_hasil' => $request->buka_hasil,
            'tampil_otomatis' => $tampil_otomatis,
            'buka_otomatis' => $buka_otomatis,
            'batas_buka' => $batas_buka,
            'durasi' => $request->durasi,
            'attempt' => $request->attempt
        ]);


        return redirect(route('kelas.ujian', ['kelas' => $kelas->id]));
    }

}
