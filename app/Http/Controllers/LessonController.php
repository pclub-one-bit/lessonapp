<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLesson;
use App\Lesson;
use Illuminate\Http\Request;
use Storage;

class LessonController extends AppController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lessons = Lesson::orderBy('lesson_datetime', 'desc')->paginate(10);
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
        $result = \DB::transaction(function () use ($request) {
            $lesson = new Lesson;
            $count = 0;
            if ($request->participants) {
                $count = count($request->participants);
            }
            $result = $lesson->create(array_merge($request->all(), ['total_participant' => $count]));
            if (!$result) {
                return $result;
            }
            $lesson = $result;
            if ($request->participants) {
                foreach ($request->participants as $participant) {
                    $result = $lesson->participants()->create($participant);
                    if (!$result) {
                        return $result;
                    }
                }
            }
            if ($request->revenues) {
                foreach ($request->revenues as $revenue) {
                    $result = $lesson->revenues()->create($revenue);
                    if (!$result) {
                        return $result;
                    }
                }
            }

            $files = $request->file();
            if ($request->expenses) {
                foreach ($request->expenses as $idx => $expense) {
                    if (isset($files['expenses'][$idx]['receipt'])) {
                        $path = Storage::disk('s3')->putFile('/', $files['expenses'][$idx]['receipt']);
                        $expense['receipt_path'] = $path;
                        $expense['receipt_original_name'] = $files['expenses'][$idx]['receipt']->getClientOriginalName();
                        $expense['receipt_mime'] = $files['expenses'][$idx]['receipt']->getMimeType();
                    }
                    $result = $lesson->expenses()->create($expense);
                    if (!$result) {
                        return $result;
                    }
                }
            }

            return true;

        });
        if ($result) {
            $request->session()->flash('message', '保存しました。');
            return redirect('lessons');
        } else {
            $request->session()->flash('message', 'エラーが発生しました。');
            return view('lessons.create');
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
        $result = \DB::transaction(function () use ($lesson, $request) {
            $lesson->fill($request->all());
            $count = 0;
            if ($request->participants) {
                $count = count($request->participants);
            }
            $lesson->total_participant = $count;
            $result = $lesson->save();
            if (!$result) {
                return $result;
            }
            $lesson->participants()->delete();
            if ($request->participants) {
                foreach ($request->participants as $participant) {
                    $result = $lesson->participants()->create($participant);
                    if (!$result) {
                        return $result;
                    }
                }
            }
            $lesson->revenues()->delete();
            if ($request->revenues) {
                foreach ($request->revenues as $revenue) {
                    $result = $lesson->revenues()->create($revenue);
                    if (!$result) {
                        return $result;
                    }
                }
            }
            $lesson->expenses()->delete();
            if ($request->expenses) {
                foreach ($request->expenses as $expense) {
                    $result = $lesson->expenses()->create($expense);
                    if (!$result) {
                        return $result;
                    }
                }
            }

            return true;

        });
        if ($result) {
            $request->session()->flash('message', '更新しました。');
            return redirect('lessons');
        } else {
            $request->session()->flash('message', 'エラーが発生しました。');
            return view('lessons.edit', ['lesson' => $lesson]);
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
            return redirect('lessons')->with('message', 'エラーが発生しました。');
        }
    }

}
