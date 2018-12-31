@php
    $title = __('新規作成');
@endphp
@extends('layouts.app')
@section('content')
<div class="container">
    <h1>{{ $title }}</h1>
    <div class="row">
        <div class="col-sm-6">
            {!! Form::open(['url' => 'lessons', 'method' => 'post']) !!}
                <div class="form-group">
                    <label for="subject">{{ __('columns.subject') }}</label>
                    {!! Form::text('subject', null, ['class' => 'form-control', 'required' => 'required' . ( $errors->has('subject') ? ' is-invalid' : '' )]) !!}
                    @component('components.invalid-feedback')
                        @slot('field', 'subject')
                    @endcomponent
                </div>
                <div class="form-group">
                    <label for="lesson_datetime">{{ __('columns.lesson_datetime') }}</label>
                    {!! Form::input('datetime-local', 'lesson_datetime', null, ['class' => 'form-control' . ( $errors->has('lesson_datetime') ? ' is-invalid' : '' ), 'required' => 'required']) !!}
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
                    {!! Form::select('evaluation', config('pref.evaluation'), null, ['class' => 'form-control' . ( $errors->has('evaluation') ? ' is-invalid' : '' )]) !!}
                    @component('components.invalid-feedback')
                        @slot('field', 'evaluation')
                    @endcomponent
                </div>
                <div class="form-group">
                    <label for="total_participant">{{ __('columns.total_participant') }}</label>
                    {!! Form::text('total_participant', null, ['class' => 'form-control' . ( $errors->has('total_participant') ? ' is-invalid' : '' )]) !!}
                    @component('components.invalid-feedback')
                        @slot('field', 'total_participant')
                    @endcomponent
                </div>
                <div class="form-group">
                    <label for="total_revenue">{{ __('columns.total_revenue') }}</label>
                    {!! Form::text('total_revenue', null, ['class' => 'form-control' . ( $errors->has('total_revenue') ? ' is-invalid' : '' )]) !!}
                    @component('components.invalid-feedback')
                        @slot('field', 'total_revenue')
                    @endcomponent
                </div>
                <div class="form-group">
                    <label for="total_expenses">{{ __('columns.total_expenses') }}</label>
                    {!! Form::text('total_expenses', null, ['class' => 'form-control' . ( $errors->has('total_expenses') ? ' is-invalid' : '' )]) !!}
                    @component('components.invalid-feedback')
                        @slot('field', 'total_expenses')
                    @endcomponent
                </div>
                <div class="form-group">
                    <label for="total_budget">{{ __('columns.total_budget') }}</label>
                    {!! Form::text('total_budget', null, ['class' => 'form-control' . ( $errors->has('total_budget') ? ' is-invalid' : '' )]) !!}
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
