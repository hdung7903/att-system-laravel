<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\GroupStudent;

class GroupController extends Controller
{

    protected function getAllGroup()
    {
        return Group::all();
    }

    public function show()
    {
        $result = $this->getAllGroup();
        return view('home', compact('result'));
    }

    public function showGroup($id)
    {
        $result = Student::join('group_student', 'user_id', '=', 'group_student.student_id')
            ->where('group_id', $id)
            ->get(['students.*']);
        return view('group', compact('result'));
    }

    public function showAddStudent(Request $request)
    {
        $groups = $this->getAllGroup();
        $group_id = $request->query('group');
        if ($group_id) {
            $result = Student::whereDoesntHave('group', function ($query) use ($group_id) {
                $query->where('group_id', $group_id);
            })->get();
            // $result=Student::with('group', function ($query) use ($groups) {
            //     $query->whereIn('group_id', $groups->pluck('id'));
            // });
            return view('addStudent', compact('result', 'groups'));
        } else {
            return view('addStudent', compact('groups'));
        }
    }

    public function addStudent(Request $request)
    {
        $group_id = $request->input('group');
        $addList = $request->input('students');
        if ($group_id && $addList) {
            $group = Group::find($group_id);
            $group->student()->attach($addList);
            return redirect("/group/{$group_id}");
        } else {
            return redirect()->back();
        }
    }

    public function removeStudent(Request $request)
    {
        $group_id = $request->input('group');
        $student = $request->input('student');
        if ($group_id && $student) {
            $group = Group::find($group_id);
            $group->student()->detach($student);
            return redirect("/group/{$group_id}");
        }
    }
}
