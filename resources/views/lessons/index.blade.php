@php
    $title = __('レッスン履歴');
    $marks = config('pref.evaluation');
@endphp
@extends('layouts.app')
@section('content')
<div class="container">
    <h1>{{ $title }}</h1>
    <p class="text-right">
        <a href="{{ url('lessons/create') }}" class="btn btn-primary">{{ __('messages.Create new') }}</a>
    </p>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>{{ __('columns.subject') }}</th>
                    <th>{{ __('columns.lesson_datetime') }}</th>
                    <th>{{ __('columns.body') }}</th>
                    <th>{{ __('columns.evaluation') }}</th>
                    <th>{{ __('columns.total_participant') }}</th>
                    <th>{{ __('columns.total_revenue') }}</th>
                    <th>{{ __('columns.total_expense') }}</th>
                    <th>{{ __('columns.total_budget') }}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($lessons as $lesson)
                    <tr>
                        <td><a href="{{ url('lessons/'.$lesson->id.'/edit') }}">{{ $lesson->subject }}</a></td>
                        <td>{{ $lesson->lesson_datetime }}</td>
                        <td>{{ $lesson->body }}</td>
                        <td>{{ isset($marks[$lesson->evaluation]) ? $marks[$lesson->evaluation] : '' }}</td>
                        <td>{{ $lesson->total_participant }}</td>
                        <td>{{ $lesson->total_revenue }}</td>
                        <td>{{ $lesson->total_expense }}</td>
                        <td>{{ $lesson->total_budget }}</td>
                        <td class="text-right">
                            @component('components.btn-del')
                                @slot('controller', 'lessons')
                                @slot('id', $lesson->id)
                                @slot('name', $lesson->title)
                            @endcomponent
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $lessons->links() }}
    </div>
</div>
@endsection
