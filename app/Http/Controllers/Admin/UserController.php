<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\CsvImportRequest;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Classroom;
use App\Role;
use App\CsvUserData;
use Carbon\Carbon;
use Throwable;

class UserController extends Controller
{

    public $userField = [
        'nama', 'email', 'username', 'password', 'role_id', 'gender', 'tanggal_lahir', 'kelas_id'
    ];

    public function create()
    {
        return view('admin.user.create', [
            'title' => 'Tambah User Baru | Area Admin',
            'item' => 'User',
            'action' => '#'
        ]);
    }

    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        $user = User::create([
            'nama' => $data['nama'],
            'email' => $data['email'],
            'username' => $data['username'],
            'password'=> Hash::make($data['password']),
            'gender' => $data['gender'],
            'tanggal_lahir' => $data['tanggal_lahir']
        ]);

        // Assign role
        $user->roles()->toggle($data['role']);

        return redirect('/admin/user');
    }

    public function index() {
        $users = User::all();

        return view('admin.user.index', [
            'title' => 'Daftar User | Area Admin',
            'users' => $users
        ]);
    }

    public function edit(User $user)    
    {   
        return view('admin.user.edit', [
            'title' => 'Edit User | Area Admin',
            'user' => $user
        ]);
    }

    public function update(Request $request, User $user)
    {
        // Perbarui data
        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->username = $request->username;

        if (!is_null($request->password)) {
            $user->password = Hash::make($request->password);
        }

        $user->roles()->sync($request->role);

        $user->gender = $request->gender;
        $user->tanggal_lahir = $request->tanggal_lahir;
        
        $user->save();

        return redirect(route('user.index'));
    }

    public function getCsv()
    {
        return view('admin.user.import-csv',[
            'title' => 'Import User dari File CSV | Area Admin',
            'userField' => $this->userField
        ]);
    }

    public function parseCsv(CsvImportRequest $request)
    {
        $path = $request->file('csv_file')->path();
        $data = array_map('str_getcsv', file($path));

        $dataToBeSaved = array_slice($data, 1);

        $dataToShow = array_slice($data, 1, 3);

        $userField = $this->userField;

        $csvDataFile = CsvUserData::create([
            'csv_filename' => $request->file('csv_file')->getClientOriginalName(),
            'csv_data' => json_encode($dataToBeSaved)
        ]);


        return view('admin.user.parse-csv',[
            'title' => 'Periksa Data CSV | User | Area Admin',
            'dataToShow' => $dataToShow, 
            'userField' => $userField,
            'csvDataFile' => $csvDataFile
        ]);
    }

    public function processImport(Request $request)
    {
        $data = CsvUserData::find($request->csv_data_file_id);
        $csvData = json_decode($data->csv_data, true);

        /* foreach ($csvData as $row) {
            $user = User::create([
                'nama' => $row[0],
                'email' => $row[1],
                'username' => $row[2],
                'password' => Hash::make($row[3]),
                'gender' => $row[5],
                'tanggal_lahir' => ($row[6] != "") ? Carbon::parse($row[6])->format('Y-m-d') : null
            ]);

            if (Role::find($row[4])) {
                $user->roles()->attach($row[4]);
            } else {
                $user->roles()->attach(3);
            }


            if (Classroom::find($row[7])) {
                $user->classrooms()->attach($row[7]);
            }

        } */

        $errors = [];

        $imported = 0;

        $updated = 0;

        foreach ($csvData as $key => $row) {
            $user = User::where('username', $row[2])->first();

            if ($user !== null) {

                try {
                    $user->classrooms()->attach($row[7]);
                    $updated++; 
                } catch (Throwable $e) {
                    $error = 'Error untuk baris ' . $key . ': ' . report($e);

                    array_push($errors, $error);
                }
            
            } else {

                try {
                    $user = User::create([
                        'nama' => $row[0],
                        'email' => $row[1],
                        'username' => $row[2],
                        'password' => Hash::make($row[3]),
                        'gender' => $row[5],
                        'tanggal_lahir' => ($row[6] != '') ? Carbon::parse($row[6])->format('Y-m-d')
                                                            : null
                    ]);
    
                    if ($row[4]) {
                        $user->assignRole($row[4]);
                    } else {
                        $user->assignRole(4);
                    }
    
                    if (Classroom::find($row[7])) {
                        $user->classrooms()->attach($row[7]);
                    }

                    $imported++;
                    
                } catch (Throwable $e) {
                    $error = 'Error untuk baris ' . $key . ': ' . report($e);

                    array_push($errors, $error);
                }

            }
        }

        return redirect(route('user.index'));
    }
}
