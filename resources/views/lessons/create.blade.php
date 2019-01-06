@php
    $title = __('新規作成');
    logger($errors);
@endphp
@extends('layouts.app')
@section('content')
<div id="lesson-create" class="container">
    <h1>{{ $title }}</h1>
    <div class="row">
        <div class="col-sm-12">
            {!! Form::open(['url' => 'lessons', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
                <div class="form-group">
                    <label for="subject">{{ __('columns.subject') }}</label>
                    {!! Form::text('subject', null, ['class' => 'form-control', 'required' => 'required' . ( $errors->has('subject') ? ' is-invalid' : '' )]) !!}
                    @component('components.invalid-feedback')
                        @slot('field', 'subject')
                    @endcomponent
                </div>
                <div class="form-group">
                    <label for="lesson_datetime">{{ __('columns.lesson_datetime') }}</label>
                    {!! Form::input('datetime-local', 'lesson_datetime', null, ['class' => 'form-control col-3' . ( $errors->has('lesson_datetime') ? ' is-invalid' : '' ), 'required' => 'required']) !!}
                    @component('components.invalid-feedback')
                        @slot('field', 'lesson_datetime')
                    @endcomponent
                </div>
                <div class="form-group">
                    <label for="body">{{ __('columns.body') }}</label>
                    {!! Form::textarea('body', null, ['class' => 'form-control' . ( $errors->has('body') ? ' is-invalid' : '' )]) !!}
                    @component('components.invalid-feedback')
                        @slot('field', 'body')
                    @endcomponent
                </div>
                <div class="form-group">
                    <label for="evaluation">{{ __('columns.evaluation') }}</label>
                    {!! Form::select('evaluation', config('pref.evaluation'), null, ['class' => 'form-control col-3' . ( $errors->has('evaluation') ? ' is-invalid' : '' )]) !!}
                    @component('components.invalid-feedback')
                        @slot('field', 'evaluation')
                    @endcomponent
                </div>
                <div id="form-participants"class="form-group">
                    <label for="participants">{{ __('columns.participants') }}</label>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>{{ __('columns.name') }}</th>
                                    <th>{{ __('columns.parent_name') }}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @for ($idx = 0;$idx < 1;$idx++)
                                    <tr>
                                        <td>
                                            {!! Form::text(sprintf('participants[%d][name]', $idx), null, ['class' => 'form-control form-control-sm col-12' . ( $errors->has(sprintf('participants.%d.name', $idx)) ? ' is-invalid' : '' ), 'required' => 'required']) !!}
                                            @component('components.invalid-feedback')
                                                @slot('field', sprintf('participants.%d.name', $idx))
                                            @endcomponent
                                        </td>
                                        <td>
                                            {!! Form::text(sprintf('participants[%d][parent_name]', $idx), null, ['class' => 'form-control form-control-sm col-12' . ( $errors->has(sprintf('participants.%d.parent_name', $idx)) ? ' is-invalid' : '' ), 'required' => 'required']) !!}
                                            @component('components.invalid-feedback')
                                                @slot('field', sprintf('participants.%d.parent_name', $idx))
                                            @endcomponent
                                        </td>
                                        <td class="text-right">
                                            <a href="#" class="btn btn-outline-secondary btn-delete">
                                                {{ __('messages.Delete') }}
                                            </a>
                                        </td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                        <a href="#" class="btn btn-outline-secondary btn-add">
                            {{ __('messages.Add') }}
                        </a>
                    </div>
                </div>
                <div id="form-revenues"class="form-group">
                    <label for="revenues">{{ __('columns.revenues') }}</label>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>{{ __('columns.item') }}</th>
                                    <th>{{ __('columns.amount') }}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @for ($idx = 0;$idx < 1;$idx++)
                                    <tr>
                                        <td>
                                            {!! Form::text(sprintf('revenues[%d][item]', $idx), null, ['class' => 'form-control form-control-sm col-12' . ( $errors->has(sprintf('revenues.%d.item', $idx)) ? ' is-invalid' : '' ), 'required' => 'required']) !!}
                                            @component('components.invalid-feedback')
                                                @slot('field', sprintf('revenues.%d.item', $idx))
                                            @endcomponent
                                        </td>
                                        <td>
                                            {!! Form::number(sprintf('revenues[%d][amount]', $idx), null, ['class' => 'form-control form-control-sm col-12' . ( $errors->has(sprintf('revenues.%d.amount', $idx)) ? ' is-invalid' : '' ), 'required' => 'required']) !!}
                                            @component('components.invalid-feedback')
                                                @slot('field', sprintf('revenues.%d.amount', $idx))
                                            @endcomponent
                                        </td>
                                        <td class="text-right">
                                            <a href="#" class="btn btn-outline-secondary btn-delete">
                                                {{ __('messages.Delete') }}
                                            </a>
                                        </td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                        <a href="#" class="btn btn-outline-secondary btn-add">
                            {{ __('messages.Add') }}
                        </a>
                    </div>
                </div>
                <div class="form-group">
                    <label for="total_revenue">{{ __('columns.total_revenue') }}</label>
                    {!! Form::text('total_revenue', 0, ['class' => 'form-control col-3' . ( $errors->has('total_revenue') ? ' is-invalid' : '' ), 'readonly' => 'readonly']) !!}
                    @component('components.invalid-feedback')
                        @slot('field', 'total_revenue')
                    @endcomponent
                </div>
                <div id="form-expenses"class="form-group">
                    <label for="expenses">{{ __('columns.expenses') }}</label>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>{{ __('columns.item') }}</th>
                                    <th>{{ __('columns.amount') }}</th>
                                    <th>{{ __('columns.receipt') }}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @for ($idx = 0;$idx < 1;$idx++)
                                    <tr>
                                        <td>
                                            {!! Form::text(sprintf('expenses[%d][item]', $idx), null, ['class' => 'form-control form-control-sm col-12' . ( $errors->has(sprintf('expenses.%d.item', $idx)) ? ' is-invalid' : '' ), 'required' => 'required']) !!}
                                            @component('components.invalid-feedback')
                                                @slot('field', sprintf('expenses.%d.item', $idx))
                                            @endcomponent
                                        </td>
                                        <td>
                                            {!! Form::number(sprintf('expenses[%d][amount]', $idx), null, ['class' => 'form-control form-control-sm col-12' . ( $errors->has(sprintf('expenses.%d.amount', $idx)) ? ' is-invalid' : '' ), 'required' => 'required']) !!}
                                            @component('components.invalid-feedback')
                                                @slot('field', sprintf('expenses.%d.amount', $idx))
                                            @endcomponent
                                        </td>
                                        <td>
                                            <div class="row">
                                                {!! Form::file(sprintf('expenses[%d][receipt]', $idx), ['class' => 'form-control form-control-sm col-6' . ( $errors->has(sprintf('expenses.%d.receipt', $idx)) ? ' is-invalid' : '' )]) !!}
                                                @component('components.invalid-feedback')
                                                    @slot('field', sprintf('expenses.%d.receipt', $idx))
                                                @endcomponent
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            <a href="#" class="btn btn-outline-secondary btn-delete">
                                                {{ __('messages.Delete') }}
                                            </a>
                                        </td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                        <a href="#" class="btn btn-outline-secondary btn-add">
                            {{ __('messages.Add') }}
                        </a>
                    </div>
                </div>
                <div class="form-group">
                    <label for="total_expense">{{ __('columns.total_expense') }}</label>
                    {!! Form::text('total_expense', 0, ['class' => 'form-control col-3' . ( $errors->has('total_expense') ? ' is-invalid' : '' ), 'readonly' => 'readonly']) !!}
                    @component('components.invalid-feedback')
                        @slot('field', 'total_expense')
                    @endcomponent
                </div>
                <div class="form-group">
                    <label for="total_budget">{{ __('columns.total_budget') }}</label>
                    {!! Form::text('total_budget', 0, ['class' => 'form-control col-3' . ( $errors->has('total_budget') ? ' is-invalid' : '' ), 'readonly' => 'readonly']) !!}
                    @component('components.invalid-feedback')
                        @slot('field', 'total_budget')
                    @endcomponent
                </div>
                <button type="submit" name="submit" class="btn btn-primary">{{ __('messages.Save') }}</button>
                <a href="{{ url('lessons') }}" class="btn btn-outline-secondary">{{ __('messages.List') }}</a>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
