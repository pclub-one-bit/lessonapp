@extends('layouts.app')
@section('content')
<div class="container">
    <h1>{{ $lesson->subject }}</h1>

    {{-- 編集・削除ボタン --}}
    <div>
        <a href="{{ url('lessons/'.$lesson->id.'/edit') }}" class="btn btn-primary">
            {{ __('編集') }}
        </a>
        @component('components.btn-del')
            @slot('controller', 'lessons')
            @slot('id', $lesson->id)
            @slot('name', $lesson->title)
        @endcomponent
    </div>
    <br>
    {{-- レッスン1件の情報 --}}
    <div class="row">
        <div class="col-sm-6">
            {!! Form::model($lesson, ['url' => 'lessons/'.$lesson->id, 'method' => 'put']) !!}
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="subject">{{ __('タイトル') }}</label>
                    {!! Form::text('subject', null, ['class' => 'form-control', 'required' => 'required' . ( $errors->has('subject') ? ' is-invalid' : '' ), 'disabled' => 'disabled']) !!}
                    @component('components.invalid-feedback')
                        @slot('field', 'subject')
                    @endcomponent
                </div>
                <div class="form-group">
                    <label for="lesson_datetime">{{ __('開催日時') }}</label>
                    {!! Form::input('datetime-local', 'lesson_datetime', to_datetime_local($lesson->lesson_datetime), ['class' => 'form-control' . ( $errors->has('lesson_datetime') ? ' is-invalid' : '' ), 'required' => 'required', 'disabled' => 'disabled']) !!}
                    @component('components.invalid-feedback')
                        @slot('field', 'lesson_datetime')
                    @endcomponent
                </div>
                <div class="form-group">
                    <label for="body">{{ __('内容') }}</label>
                    {!! Form::textarea('body', null, ['class' => 'form-control' . ( $errors->has('body') ? ' is-invalid' : '' ), 'disabled' => 'disabled']) !!}
                    @component('components.invalid-feedback')
                        @slot('field', 'body')
                    @endcomponent
                </div>
                <div class="form-group">
                    <label for="evaluation">{{ __('評価') }}</label>
                    {!! Form::select('evaluation', config('pref.evaluation'), null, ['class' => 'form-control' . ( $errors->has('evaluation') ? ' is-invalid' : '' ), 'disabled' => 'disabled']) !!}
                    @component('components.invalid-feedback')
                        @slot('field', 'evaluation')
                    @endcomponent
                </div>
                <div class="form-group">
                    <label for="total_participant">{{ __('参加人数') }}</label>
                    {!! Form::text('total_participant', null, ['class' => 'form-control' . ( $errors->has('total_participant') ? ' is-invalid' : '' ), 'disabled' => 'disabled']) !!}
                    @component('components.invalid-feedback')
                        @slot('field', 'total_participant')
                    @endcomponent
                </div>
                <div class="form-group">
                    <label for="total_revenue">{{ __('収入合計') }}</label>
                    {!! Form::text('total_revenue', null, ['class' => 'form-control' . ( $errors->has('total_revenue') ? ' is-invalid' : '' ), 'disabled' => 'disabled']) !!}
                    @component('components.invalid-feedback')
                        @slot('field', 'total_revenue')
                    @endcomponent
                </div>
                <div class="form-group">
                    <label for="total_expenses">{{ __('経費合計') }}</label>
                    {!! Form::text('total_expenses', null, ['class' => 'form-control' . ( $errors->has('total_expenses') ? ' is-invalid' : '' ), 'disabled' => 'disabled']) !!}
                    @component('components.invalid-feedback')
                        @slot('field', 'total_expenses')
                    @endcomponent
                </div>
                <div class="form-group">
                    <label for="total_budget">{{ __('収支') }}</label>
                    {!! Form::text('total_budget', null, ['class' => 'form-control' . ( $errors->has('total_budget') ? ' is-invalid' : '' ), 'disabled' => 'disabled']) !!}
                    @component('components.invalid-feedback')
                        @slot('field', 'total_budget')
                    @endcomponent
                </div>
            {!! Form::close() !!}
        </div>
    </div>
    <a href="#" onclick="history.back()" class="btn btn-outline-secondary">{{ __('戻る') }}</a>
</div>
@endsection
