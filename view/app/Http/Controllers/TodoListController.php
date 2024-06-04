<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TodoList;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TodoListController extends Controller
{
    public function store(Request $request)
    {

        $request->validate([
            "title" => 'required|string|max:100',
            "status" => 'nullable|boolean',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
        ]);

        $datetime = Carbon::createFromFormat('Y-m-d H:i', $request->input('date') . ' ' . $request->input('time'));

        $todoList = new TodoList(
            [
                "name" => Auth::user()->name,
                "title" => $request->input('title'),
                "status" => $request->input('status', false),
                "datetime" => $datetime->toDateTimeString(),
            ]
        );

        $todoList->save();

        return redirect('/list')->with('success', 'Add a new todo-list successfully!');
    }

    public function index(){
        $todoLists=Todolist::where('name', Auth::user()->name)->get();
        return view('todolist.list', compact('todoLists'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "title" => 'required|string|max:100',
            "status" => 'nullable|boolean',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
        ]);

        $todoList = TodoList::findOrFail($id);

        $datetime = Carbon::createFromFormat('Y-m-d H:i', $request->input('date') . ' ' . $request->input('time'));

        $todoList->title = $request->input('title');
        $todoList->status = $request->input('status', false);
        $todoList->datetime = $datetime;

        $todoList->save();

        return redirect()->route('todolist.list')->with('success', 'TodoList updated successfully');
    }

    public function destroy($id)
    {
        $todoList = TodoList::findOrFail($id);
        $todoList->delete();
        return redirect('/list')->with('success', 'Delete a todo-list successfully!');
    }

    public function toggleStatus($id)
    {
        $todoList = TodoList::find($id);

        if ($todoList && $todoList->name == Auth::user()->name) {
            $todoList->status = !$todoList->status;
            $todoList->save();
        }

        return redirect()->route('todolist.index');
    }

    public function filter(Request $request)
    {
        $name = Auth::user()->name;
        $dateFilter = $request->query('searchDate');
        $statusFilter = $request->query('searchStatus');
        $titleFilter = $request->query('searchTitle');

        $result =TodoList::where("name",$name)
        ->where('datetime','like', '%'.$dateFilter.'%')
        ->where('title', 'like', '%'.$titleFilter.'%');
        if($statusFilter!="all"){
            $result->whereIn('status', $statusFilter);
        }
        
        $todoLists=$result->get();

        return view('todolist.list', compact('todoLists'));
    }
}
