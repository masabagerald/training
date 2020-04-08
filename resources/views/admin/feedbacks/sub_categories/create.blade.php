@extends('layouts.app')

@section('content')
    <h3 class="page-title">Sub Category</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.subcategories.store']]) !!}

    <div class="box box-info">
        <div class="box-header">

        </div>

        <div class="box-body">






          <div class="row">
            <div class="col-xs-6 form-group">
                {!! Form::label('title', 'Title:') !!}
                {!! Form::text('title','',['class' => 'form-control']) !!}
            </div>

                <div class="col-xs-6 form-group">
                    {!! Form::label('category_id', 'Category'.'', ['class' => 'control-label']) !!}
                    {!! Form::select('category_id', $categories, old('category_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('job_title_id'))
                        <p class="help-block">
                            {{ $errors->first('job_title_id') }}
                        </p>
                    @endif
                </div>



                {!! Form::submit() !!}

        </div>
        {!! Form::close() !!}

    </div>

    </div>



@stop

