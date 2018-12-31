@php
    $title = __('ユーザー') . '：' . $user->name;
@endphp
@extends('layouts.app')
@section('content')
<div class="container">
    <h1>{{ $title }}</h1>

    {{-- 編集・削除ボタン --}}
    <div>
        <a href="{{ url('users/'.$user->id.'/edit') }}" class="btn btn-primary">
            {{ __('編集') }}
        </a>
        @component('components.btn-del')
            @slot('controller', 'users')
            @slot('id', $user->id)
            @slot('name', $user->title)
        @endcomponent
    </div>
    <br>
    {{-- ユーザー1件の情報 --}}
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="ID">{{ __('ID') }}</label>
                <input id="ID" type="text" class="form-control" name="ID" value="{{ $user->id }}" readonly>
            </div>
            <div class="form-group">
                <label for="name">{{ __('名前') }}</label>
                <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" readonly>
            </div>
            <div class="form-group">
                <label for="email">{{ __('E-Mail') }}</label>
                <input id="email" type="text" class="form-control" name="email" value="{{ $user->email }}" readonly>
            </div>
        </div>
    </div>
    <a href="#" onclick="history.back()" class="btn btn-outline-secondary">{{ __('戻る') }}</a>
</div>
@endsection
