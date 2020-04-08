@extends('layouts.app')

@section('content')
    <h3 class="page-title">Training Report</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.reports.store']]) !!}

    <div class="box box-default">
        <div class="box-heading">
            @lang('quickadmin.qa_create')
        </div>
        
        <div class="box-body">
            <div class="row">
                <div class="col-xs-4 form-group">
                    {!! Form::label('training name', 'training name'.'*', ['class' => 'control-label']) !!}
                    {!! Form::text('training_name', old('training_name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('training_name'))
                        <p class="help-block">
                            {{ $errors->first('training_name') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-4 form-group">
                    {!! Form::label('training type', 'training type'.'*', ['class' => 'control-label']) !!}
                    {!! Form::text('training_type', old('training_type'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('training_type'))
                        <p class="help-block">
                            {{ $errors->first('training_type') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-4 form-group">
                    {!! Form::label('training venue', 'training venue'.'*', ['class' => 'control-label']) !!}
                    {!! Form::text('training_venue',  old('training_venue'), ['class' => 'form-control', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('training_venue'))
                        <p class="help-block">
                            {{ $errors->first('training_venue') }}
                        </p>
                    @endif
            </div>
            
            </div>
            <div class="row">
                <div class="col-xs-6 form-group">
                        {!! Form::label('Start Date', 'Start Date'.'*', ['class' => 'control-label']) !!}
                        {!! Form::date('start_date', old('start_date'),['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                        <p class="help-block"></p>
                        @if($errors->has('start_date'))
                            <p class="help-block">
                                {{ $errors->first('start_date') }}
                            </p>
                        @endif
                </div>
                <div class="col-xs-6 form-group">
                            {!! Form::label('End Date', 'Start Date'.'*', ['class' => 'control-label']) !!}
                            {!! Form::Date('end_date',old('end_date'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                            <p class="help-block"></p>
                            @if($errors->has('end_date'))
                                <p class="help-block">
                                    {{ $errors->first('end_date') }}
                                </p>
                            @endif
                </div>
            
        </div>
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('training objectives', 'training objectives'.'*', ['class' => 'control-label']) !!}
                    {!! Form::textarea('training_objectives', old('training_objectives'),['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('training_objectives'))
                        <p class="help-block">
                            {{ $errors->first('training_objectives') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-6 form-group">
                    {!! Form::label('Expected Outcomes', 'Expected Outcomes'.'*', ['class' => 'control-label']) !!}
                    {!! Form::textarea('expected_outcome',old('expected_outcome'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('expected_outcome'))
                        <p class="help-block">
                            {{ $errors->first('expected_outcome') }}
                        </p>
                    @endif
            </div>
                
            </div>
           
            <div class="row">
                   
                        <div class="col-xs-6 form-group">
                                {!! Form::label('challenges', 'challenges'.'*', ['class' => 'control-label']) !!}
                                {!! Form::textarea('challenges',old('challenges'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                                <p class="help-block"></p>
                                @if($errors->has('challenges'))
                                    <p class="help-block">
                                        {{ $errors->first('challenges') }}
                                    </p>
                                @endif
                        </div>
                        <div class="col-xs-6 form-group">
                            {!! Form::label('recommendation', 'recommendation'.'*', ['class' => 'control-label']) !!}
                            {!! Form::textarea('recommendation',old('recommendation'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                            <p class="help-block"></p>
                            @if($errors->has('recommendation'))
                                <p class="help-block">
                                    {{ $errors->first('recommendation') }}
                                </p>
                            @endif
                    </div>
                
            </div>
           

            <div class="row">
                <div class="col-xs-6 form-group">
                        {!! Form::label('participants list', 'participants list', ['class' => 'control-label']) !!}
                        
                        {!! Form::file('participants_list',old('participants_list'),['class' => 'form-control']) !!}
                        <p class="help-block"></p>
                        @if($errors->has('participants_list'))
                            <p class="help-block">
                                {{ $errors->first('participants_list') }}
                            </p>
                        @endif
                    </div>
                    <div class="col-xs-6 form-group">
                            {!! Form::label('facilitators list', 'facilitators list'.'*', ['class' => 'control-label']) !!}
                            {!! Form::file('facilitators_list',old('facilitators_list'),['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                            <p class="help-block"></p>
                            @if($errors->has('facilitators_list'))
                                <p class="help-block">
                                    {{ $errors->first('facilitators_list') }}
                                </p>
                            @endif
                    </div>
            </div>
            
        </div>
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

