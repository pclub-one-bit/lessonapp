<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLesson;
use App\Lesson;
use Illuminate\Http\Request;

class LessonController extends AppController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lessons = Lesson::latest()->paginate(10);
        return view('lessons.index', ['lessons' => $lessons]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('lessons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLesson $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLesson $request)
    {
        $lesson = new Lesson;
        $lesson->subject = $request->subject;
        $lesson->lesson_datetime = $request->lesson_datetime;
        $lesson->body = $request->body;
        $lesson->evaluation = $request->evaluation;
        $lesson->total_participant = $request->total_participant;
        $lesson->total_revenue = $request->total_revenue;
        $lesson->total_expenses = $request->total_expenses;
        $lesson->total_budget = $request->total_budget;

        $result = \DB::transaction(function () use ($lesson) {
            return $lesson->save();
        });
        if ($result) {
            $request->session()->flash('message', '保存しました。');
            return redirect('lessons');
        } else {
            $request->session()->flash('message', 'エラーが発生しました。');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  Lesson  $Lesson
     * @return \Illuminate\Http\Response
     */
    public function show(Lesson $lesson)
    {
        return view('lessons.show', ['lesson' => $lesson]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Lesson  $Lesson
     * @return \Illuminate\Http\Response
     */
    public function edit(Lesson $lesson)
    {
        return view('lessons.edit', ['lesson' => $lesson]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreLesson $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreLesson $request, Lesson $lesson)
    {
        $lesson->subject = $request->subject;
        $lesson->lesson_datetime = $request->lesson_datetime;
        $lesson->body = $request->body;
        $lesson->evaluation = $request->evaluation;
        $lesson->total_participant = $request->total_participant;
        $lesson->total_revenue = $request->total_revenue;
        $lesson->total_expenses = $request->total_expenses;
        $lesson->total_budget = $request->total_budget;

        $result = \DB::transaction(function () use ($lesson) {
            return $lesson->save();
        });
        if ($result) {
            $request->session()->flash('message', '更新しました。');
            return redirect('lessons');
        } else {
            $request->session()->flash('message', 'エラーが発生しました。');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lesson $lesson)
    {
        $result = \DB::transaction(function () use ($lesson) {
            return $lesson->delete();
        });
        if ($result) {
            return redirect('lessons')->with('message', '削除しました。');
        } else {
            return redirect('lessons/' . $user->id)->with('message', 'エラーが発生しました。');
        }
    }
}
