<?php

namespace App\Services\Front;

use App\ClassroomExam;
use App\ClassExamUser;
use App\Exam;
use App\Question;
use App\User;
use App\Answer;
use Illuminate\Database\Eloquent\Builder;


class HasilUjianService
{
    private $classExamId;
    private $classExam;

    public function __construct($classExamId)
    {
        $this->classExamId = $classExamId;
        $this->classExam = ClassroomExam::find($classExamId);
    }

    public function whoDidExam()
    {
        return $this->classExam->users;
    } 

    public function nilaiUserAll($examId)
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
        $userDidExam = $this->whoDidExam()->load('answers');

        $result = [];

        foreach ($userDidExam as $user) {
            $answers = $user->answers;

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

    public function nilaiUser($user)
    {
        $answers = $this->jawabanUser($user);

        $nilai = $this->nilaiTotal($answers);

        return $nilai;
    }

    public function jawabanUser($user)
    {
        // Fetch data user
        return $user->answers()->wherePivot('classroom_exam_id', '=', $this->classExamId)
                            ->wherePivot('attempt', '=', 1)
                            ->get();
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

    public function nilaiTotal($answers)
    {

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