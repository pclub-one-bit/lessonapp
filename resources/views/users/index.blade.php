@php
    $title = __('ユーザー');
@endphp
@extends('layouts.app')
@section('content')
<div class="container">
    <h1>{{ $title }}</h1>
    <p class="text-right">
        <a href="{{ url('users/create') }}" class="btn btn-primary">{{ __('messages.Create new') }}</a>
    </p>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>{{ __('columns.name') }}</th>
                    <th>{{ __('columns.email') }}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td><a href="{{ url('users/'.$user->id . '/edit') }}">{{ $user->name }}</a></td>
                        <td>{{ $user->email }}</td>
                        <td class="text-right">
                            @component('components.btn-del')
                                @slot('controller', 'users')
                                @slot('id', $user->id)
                                @slot('name', $user->title)
                            @endcomponent
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $users->links() }}
    </div>
</div>
@endsection
