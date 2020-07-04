<?php

namespace App\Services\Front;

use App\ClassExamUser;
use App\Exam;
use App\Question;
use App\User;

class HasilUjianService
{
    private $classExamId;

    public function __construct($classExamId)
    {
        $this->classExamId = $classExamId;
    }

    public function whoDidExam()
    {
        return ClassExamUser::where('classroom_exam_id',$this->classExamId)->pluck('user_id')->toArray();
    } 

    public function nilaiUser($examId)
    {
        // Hasil yang diharapkan dari fungsi ini adalah suatu array
        // yang isinya ID user dan nilainya
        // $nilaiUser = [
        //     0 => [
        //         'userId' => xxx
        //         'nama' => xxx
        //         'nilai' => 100
        //     ]
        //     ...
        // ]
        
        // Daftar peserta yang udah ujian
        $userDidExam = [];

        foreach ($this->whoDidExam() as $userId) {
            $user = User::find($userId);

            $userDidExam[] = $user;
        }

        $result = [];

        foreach ($userDidExam as $user) {
            $answers = $user->answers()->where([
                ['classroom_exam_id', $this->classExamId],
                ['attempt', 1], // TODO: getting the last attempt
                ])->get();

            $nilai = [];

            foreach ($answers as $answer) {
                $nilai[] = $answer->nilai;
            }

            $result[] = [
                'userId' => $user->id,
                'nama' => $user->nama,
                'username' => $user->username,
                'nilai' => array_sum($nilai)
            ];
        }

        return $result;
    }

    public function jawabanUser(User $user)
    {
        $jawabanUser = [];


    }
}