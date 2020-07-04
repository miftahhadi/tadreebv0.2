<?php

namespace App\Services\Front;

use App\ClassExamUser;
use App\Exam;
use App\Question;
use App\User;
use App\Answer;

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
            $answers = $this->jawabanUser($user);

            $nilai = $this->nilaiTotal($answers);

            $result[] = [
                'userId' => $user->id,
                'nama' => $user->nama,
                'username' => $user->username,
                'nilai' => $nilai
            ];
        }

        return $result;
    }

    public function jawabanUser(User $user)
    {
        return $user->answers()->where([
            ['classroom_exam_id', $this->classExamId],
            ['attempt', 1], // TODO: getting the last attempt
            ])->get();
    }

    public function jawabanUserArray(User $user, Exam $exam) 
    {
        // Output yang diharapkan:
        // $result = [
        //     [
        //         'soal_id' => 'jawaban_id'
        //     ]
        // ]

        $answers = $this->jawabanUser($user);

        $result = [];

        foreach ($exam->questions as $question) {
            $answer = $answers->where('question_id', $question->id)->pluck('id')->toArray();

            $result[$question->id] = $answer;
        }

        return $result;
    }

    public function nilaiTotal($user)
    {

        $answers = $this->jawabanUser($user);

        $nilai = [];

        foreach ($answers as $answer) {
            $nilai[] = $answer->nilai;
        }
        
        return array_sum($nilai);
    }

    public function nilaiUjian(Exam $exam)
    {
        $nilai = [];

        foreach ($exam->questions as $soal) {
            foreach ($soal->answers as $answer) {
                if ($answer->nilai > 0) {
                    $nilai[] = $answer->nilai;
                }
            }
        }

        return array_sum($nilai);
    }

    public function inputType(Question $question)
    {

        $benar = [];

        foreach ($question->answers as $answer) {
            if ($answer->benar == 1) {
                $benar[] = 1;
            }
        }

        if (count($benar) > 1) {
            $input = 'checkbox';
        } else {
            $input = 'radio';
        }

        return $input;
    }

    public function inputTypeMass(Exam $exam)
    {
        $result = [];

        foreach ($exam->questions as $soal) {
            $input = $this->inputType($soal);

            $result[$soal->id] = $input;
        }

        return $result;
    }
}