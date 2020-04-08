@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.roles.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.categories.store']]) !!}
    <ul>

         <li>
            {!! Form::label('title', 'Title:') !!}
            {!! Form::text('title') !!}
        </li>
        <li>
            {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
        </li>
    </ul>
 }

@stop

