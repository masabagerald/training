@extends('layouts.app')

@section('content')
    <h3 class="page-title">Training Results</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.results.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_create')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('participant_id', 'Participant'.'*', ['class' => 'control-label']) !!}
                    {!! Form::select('participant_id', $participants, old('participant_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('participant_id'))
                        <p class="help-block">
                            {{ $errors->first('participant_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('training_id', 'Training'.'*', ['class' => 'control-label']) !!}
                    {!! Form::select('training_id', $trainings, old('training_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('training_id'))
                        <p class="help-block">
                            {{ $errors->first('training_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('pre_test', 'Pre-test score'.'*', ['class' => 'control-label']) !!}
                    {!! Form::text('pre_test', old('pre_test'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('pre_test'))
                        <p class="help-block">
                            {{ $errors->first('pre_test') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('post_test', 'Post-test score'.'*', ['class' => 'control-label']) !!}
                    {!! Form::text('post_test', old('post_test'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('post_test'))
                        <p class="help-block">
                            {{ $errors->first('post_test') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('remarks', 'Remarks'.'*', ['class' => 'control-label']) !!}
                    {!! Form::text('remarks', old('remarks'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('remarks'))
                        <p class="help-block">
                            {{ $errors->first('remarks') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('comments', 'Comments'.'*', ['class' => 'control-label']) !!}
                    {!! Form::text('comments', old('comments'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('comments'))
                        <p class="help-block">
                            {{ $errors->first('comments') }}
                        </p>
                    @endif
                </div>
            </div>

        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

