<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddUserRequest;
use App\Models\Academics;
use App\Models\Instructors;
use App\Models\Students;
use App\Models\Admins;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\PendingUserDetails;
use App\Models\UserRole;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.home");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(AddUserRequest $request)
    {
        $role = $request->input("role");
        $username = $request->input("username");
        $password = $request->input("password");
        $firstname = trim($request->input("firstname"));
        $lastname = trim($request->input("lastname"));
        $email = $request->input("email");
        $dob = $request->input("dob");
        $gender = $request->input("gender");

        DB::beginTransaction();

        try {
            $user = User::create([
                "username" => $username,
                "password" => bcrypt($password),
                "email" => $email,
            ]);

            $user->roles()->attach($role);

            if ($role == 1) {
                Students::create([
                    "user_id" => $user->id,
                    "firstname" => $firstname,
                    "lastname" => $lastname,
                    "dob" => Carbon::parse($dob)->format('Y-m-d'),
                    "gender" => $gender,
                ]);
            } elseif ($role == 2) {
                Instructors::create([
                    "user_id" => $user->id,
                    "firstname" => $firstname,
                    "lastname" => $lastname,
                    "dob" => Carbon::parse($dob)->format('Y-m-d'),
                    "gender" => $gender,
                ]);
            } elseif ($role == 3) {
                Academics::create([
                    "user_id" => $user->id,
                    "firstname" => $firstname,
                    "lastname" => $lastname,
                    "dob" => Carbon::parse($dob)->format('Y-m-d'),
                    "gender" => $gender,
                ]);
            } else {
                Admins::create([
                    "user_id" => $user->id,
                    "firstname" => $firstname,
                    "lastname" => $lastname,
                    "dob" => Carbon::parse($dob)->format('Y-m-d'),
                    "gender" => $gender,
                ]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'User creation failed: ' . $e->getMessage()]);
        }
        return redirect()->route('admin.adduser')->with('success', 'User added successfully.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $another = User::withTrashed()->with('instructor', 'student', 'admin', 'academic', 'roles')->get();
        $studentList = Students::with('user.roles')->get();
        $instructorList = Instructors::with('user.roles')->get();
        $adminList = Admins::with('user.roles')->get();
        $academicList = Academics::with('user.academic')->get();

        $raw_userList = $studentList->pluck('user')
            ->merge($instructorList->pluck('user'))
            ->merge($adminList->pluck('user'))
            ->merge($academicList->pluck('user'))
            ->merge($another)
            ->where('is_pending', 0)
            ->filter()
            ->unique('id');
        $pending=User::where('is_pending', 1)->count();
        $userList = $raw_userList->map(function ($user) {
            return [
                'id' => $user->id,
                'username' => $user->username,
                'email' => $user->email,
                'status' => $user->deleted_at == null ? 'Active' : 'Inactive',
                'firstname' => optional($user->student)->firstname ?? optional($user->instructor)->firstname ?? optional($user->academic)->firstname ?? optional($user->admin)->firstname,
                'lastname' => optional($user->student)->lastname ?? optional($user->instructor)->lastname ?? optional($user->academic)->lastname ?? optional($user->admin)->lastname,
                'roles' => $user->roles->pluck('name')->toArray(),
            ];
        });
        return view("admin.userlist", compact("userList","pending"));
    }


    public function showUserDetails(int $id)
    {

        $user = User::with(['instructor', 'student', 'admin', 'academic', 'roles'])
            ->where('id', $id)
            ->first();

        $details = collect();

        if ($user) {

            if ($user->student) {
                $studentDetails = [
                    'id' => $user->student->id,
                    'username' => $user->username ?? null,
                    'email' => $user->email,
                    'firstname' => $user->student->firstname,
                    'lastname' => $user->student->lastname,
                    'gender' => $user->student->gender,
                    'dob' => $user->student->dob ? Carbon::parse($user->student->dob)->format('d-m-Y') : null,
                    'roles' => $user->roles->pluck('name')->toArray(),
                ];
                $details->push($studentDetails);
            }


            if ($user->instructor) {
                $instructorDetails = [
                    'id' => $user->instructor->id,
                    'username' => $user->username ?? null,
                    'email' => $user->email,
                    'firstname' => $user->instructor->firstname,
                    'lastname' => $user->instructor->lastname,
                    'gender' => $user->instructor->gender,
                    'dob' => $user->instructor->dob ? Carbon::parse($user->instructor->dob)->format('d-m-Y') : null,
                    'roles' => $user->roles->pluck('name')->toArray(),
                ];
                $details->push($instructorDetails);
            }

            if ($user->academic) {
                $academicDetails = [
                    'id' => $user->academic->id,
                    'username' => $user->username ?? null,
                    'email' => $user->email,
                    'firstname' => $user->academic->firstname,
                    'lastname' => $user->academic->lastname,
                    'gender' => $user->academic->gender,
                    'dob' => $user->academic->dob ? Carbon::parse($user->academic->dob)->format('d-m-Y') : null,
                    'roles' => $user->roles->pluck('name')->toArray(),
                ];
                $details->push($academicDetails);
            }

            if ($user->admin) {
                $adminDetails = [
                    'id' => $user->admin->id,
                    'username' => $user->username ?? null,
                    'email' => $user->email,
                    'firstname' => $user->admin->firstname,
                    'lastname' => $user->admin->lastname,
                    'gender' => $user->admin->gender,
                    'dob' => $user->admin->dob ? Carbon::parse($user->admin->dob)->format('d-m-Y') : null,
                    'roles' => $user->roles->pluck('name')->toArray(),
                ];
                $details->push($adminDetails);
            }
        }

        return view("admin.userdetails", compact("details"));
    }

    public function showAddForm()
    {
        return view("admin.adduser");
    }

    public function showImportForm()
    {
        return view("admin.import");
    }

    public function softDeleteUser(int $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.userlist');
    }

    public function forceDeleteUser(int $id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->forceDelete();
        return redirect()->route('admin.userlist');
    }

    public function restoreUser(int $id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();
        return redirect()->route('admin.userlist');
    }

    public function pendingUser()
    {
        $pendingUsers = User::with('pendingUserDetail')->where('is_pending', 1)->get();
        return view('admin.pending', compact('pendingUsers'));
    }

    public function deletePendingUser($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->forceDelete();
        }
        return redirect()->back();
    }

    public function approveUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $roleId = $request->input('role');
        $pendingDetail = PendingUserDetails::where('user_id', $id)->first();

        DB::transaction(function () use ($user, $pendingDetail, $roleId) {
            $user->is_pending = 0;
            $user->save();

            UserRole::create([
                'user_id' => $user->id,
                'role_id' => $roleId,
            ]);

            $roleTableMap = [
                1 => 'students',
                2 => 'instructors',
                3 => 'academics',
                4 => 'admins',
            ];

            DB::table($roleTableMap[$roleId])->insert([
                'user_id' => $user->id,
                'firstname' => $pendingDetail->firstname,
                'lastname' => $pendingDetail->lastname,
                'dob' => $pendingDetail->dob,
                'gender' => $pendingDetail->gender,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $pendingDetail->delete();
        });

        return redirect()->back();
    }

    public function importUserListData(){
        
    }
}
