@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="card">
                <div class="card-header">{{ __('messages.All budgets(Pie)')}}</div>
                <div class="card-body">
                    <div id="chart-budget-pie"></div>
                </div>
                <?=$lava->render('PieChart', 'BudgetPie', 'chart-budget-pie')?>
            </div>
        </div>
    </div>
    <div class="mt-3 row">
        <div class="col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">{{ __('messages.All budgets(Line)')}}</div>
                <div class="card-body">
                    <div id="chart-budget-line"></div>
                </div>
                <?=$lava->render('LineChart', 'BudgetLine', 'chart-budget-line')?>
            </div>
        </div>
    </div>
    <div class="mt-3 row">
        <div class="col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">{{ __('messages.Chart of participant')}}</div>
                <div class="card-body">
                    <div id="chart-participant-line"></div>
                </div>
                <?=$lava->render('LineChart', 'ParticipantLine', 'chart-participant-line')?>
            </div>
        </div>
    </div>
</div>
@endsection
