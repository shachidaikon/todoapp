<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Routine;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RoutineController extends Controller
{
    public function index(Routine $routines, Request $request)
    {
        return Inertia::render('Routine/Index')->with(['routines' => $routines->getOwnPaginateByLimit(5)]);
    }

    public function show(Routine $routine)
    {
        return Inertia::render('Routine/Show')->with(['todos' => $routine->getTodos($routine), 'routineId' => $routine->id]);
    }

    public function store(Request $request, Routine $routine)
    {
        $input = [
            'name' => $request->name,
            'remind_time' => $request->remind_time,
            'user_id' => Auth::id()
            ];
        $routine->fill($input)->save();
        return redirect()->back()->with('message', 'ルーティーンを登録しました');
    }

    public function update(Request $request, Routine $routine)
    {
        $input = [
            'name' => $request->name,
            'remind_time' => $request->remind_time,
            'user_id' => Auth::id()
            ];
        $routine->fill($input)->save();
        return redirect()->back()->with('message', '編集が完了しました');
    }

    public function destroy(Routine $routine)
    {
        $routine->delete();
        return redirect()->back()->with('message', '削除しました');;
    }
}
