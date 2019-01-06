<?php

namespace App\Http\Controllers;

use \App\Lesson;
use \Khill\Lavacharts\Lavacharts as Lava;

class HomeController extends AppController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $total_revenue = (int) Lesson::sum('total_revenue');
        $total_expense = (int) Lesson::sum('total_expense');

        $lava = new Lava;
        $budgetPieTable = $lava->DataTable();

        $budgetPieTable->addStringColumn('budget')
            ->addNumberColumn('total')
            ->addRow([__('columns.total_revenue'), $total_revenue])
            ->addRow([__('columns.total_expense'), $total_expense]);
        $lava->PieChart('BudgetPie', $budgetPieTable,
            [
                'is3D' => false,
                'height' => 300,
                'pieSliceText' => 'value',
            ]);

        $lessons = Lesson::orderBy('lesson_datetime', 'asc')->get();
        $budgetLineTable = $lava->DataTable();
        $budgetLineTable->addStringColumn(__('columns.lesson_datetime'))
            ->addNumberColumn(__('columns.total_revenue'))
            ->addNumberColumn(__('columns.total_expense'));
        foreach ($lessons as $lesson) {
            $budgetLineTable->addRow([
                $lesson->lesson_datetime,
                $lesson->total_revenue,
                $lesson->total_expense,
            ]);
        }

        $lava->LineChart('BudgetLine', $budgetLineTable,
            [
                'height' => 300,
                'pointSize' => 2,
            ]);

        $participantLineTable = $lava->DataTable();
        $participantLineTable->addStringColumn(__('columns.lesson_datetime'))
            ->addNumberColumn(__('columns.total_participant'));
        foreach ($lessons as $lesson) {
            $participantLineTable->addRow([
                $lesson->lesson_datetime,
                $lesson->total_participant,
            ]);
        }

        $lava->LineChart('ParticipantLine', $participantLineTable,
            [
                'height' => 300,
                'pointSize' => 2,
            ]);

        return view('home', compact('lava'));

    }
}
