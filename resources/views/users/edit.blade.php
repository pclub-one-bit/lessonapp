
@php
    $title = __('ユーザー編集').'：'.$user->name;
@endphp
@extends('layouts.app')
@section('content')
<div class="container">
    <h1>{{ $title }}</h1>
    <div class="row">
        <div class="col-sm-6">
            {!! Form::model($user, ['url' => 'users/'.$user->id, 'method' => 'put']) !!}
            <form action="{{ url('users/'.$user->id) }}" method="post">
                <div class="form-group">
                    <label for="subject">{{ __('columns.name') }}</label>
                    {!! Form::text('name', null, ['class' => 'form-control' . ( $errors->has('name') ? ' is-invalid' : '' ), 'required' => 'required']) !!}
                    @component('components.invalid-feedback')
                        @slot('field', 'name')
                    @endcomponent
                </div>
                <div class="form-group">
                    <label for="subject">{{ __('columns.password') }}</label>
                    {!! Form::password('password', ['class' => 'form-control' . ( $errors->has('password') ? ' is-invalid' : '' )]) !!}
                    @component('components.invalid-feedback')
                        @slot('field', 'password')
                    @endcomponent
                </div>
                <div class="form-group">
                    <label for="subject">{{ __('columns.password_confirmation') }}</label>
                    {!! Form::password('password_confirmation', ['class' => 'form-control' . ( $errors->has('password_confirmation') ? ' is-invalid' : '' )]) !!}
                    @component('components.invalid-feedback')
                        @slot('field', 'password_confirmation')
                    @endcomponent
                </div>
                <div class="form-group">
                    <label for="subject">{{ __('columns.email') }}</label>
                    {!! Form::email('email', null, ['class' => 'form-control' . ( $errors->has('email') ? ' is-invalid' : '' ), 'readonly' => 'readonly']) !!}
                    @component('components.invalid-feedback')
                        @slot('field', 'email')
                    @endcomponent
                </div>
                <button type="submit" name="submit" class="btn btn-primary">{{ __('messages.Save') }}</button>
                <a href="{{ url('users') }}" class="btn btn-outline-secondary">{{ __('messages.List') }}</a>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
