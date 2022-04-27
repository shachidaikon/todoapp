<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use Illuminate\Http\Request;
use App\Models\Todo;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class TodoController extends Controller
{
    public function index(Todo $todos)
    {                        
        return Inertia::render('Todo/Index')->with(['todos' => $todos->getOwnPaginateByLimit(5)]);
    }                               

    public function show(Todo $todo)
    {
        return Inertia::render('Todo/Show')->with(['todo' => $todo]);
    }

    public function edit(Todo $todo)
    {
        return Inertia::render('edit')->with(['todo' => $todo]);
    }

    public function store(TodoRequest $request, Todo $todo)
    {
        $input = [
            'title' => $request->title,
            'content' => $request->content,
            'is_checked' => false,
            'user_id' => Auth::id(),
            'routine_id' => $request->routine_id,
            ];
        $todo->fill($input)->save();
        return redirect()->back()->with('message', '投稿が完了しました');
    }

    public function update(TodoRequest $request, Todo $todo)
    {
        $input = [
            'title' => $request->title,
            'content' => $request->content,
            'is_checked' => $request->is_checked,
            'user_id' => Auth::id(),
            'routine_id' => $request->routine_id,
            ];
        $todo->fill($input)->save();
        return redirect()->back()->with('message', '編集が完了しました');
    }
    public function updateCheck(TodoRequest $request, Todo $todo)
    {
        $input = [
            'title' => $request->title,
            'content' => $request->content,
            'is_checked' => $request->is_checked,
            'user_id' => Auth::id(),
            'routine_id' => $request->routine_id,
            ];
        $todo->fill($input)->save();
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();
        return redirect()->back()->with('message', '削除しました');;
    }

}
