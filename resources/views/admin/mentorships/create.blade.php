@extends('layouts.app')

@section('content')
    <h3 class="page-title">Register Mentorship</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.mentorship.store']]) !!}

    <div class="box box-default">
        <div class="box-heading">
            @lang('quickadmin.qa_create')
        </div>
        
        <div class="box-body">
            <div class="row">
                <div class="col-xs-4 form-group">
                    {!! Form::label('title', trans('quickadmin.roles.fields.title').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('title'))
                        <p class="help-block">
                            {{ $errors->first('title') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-4 form-group">
                    {!! Form::label('start_date', 'Start Date'.'*', ['class' => 'control-label']) !!}
                    {!! Form::text('srart_date', old('srart_date'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('srart_date'))
                        <p class="help-block">
                            {{ $errors->first('srart_date') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-4 form-group">
                    {!! Form::label('end_date', 'end_date'.'*', ['class' => 'control-label']) !!}
                    {!! Form::text('end_date', old('end_date'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('end_date'))
                        <p class="help-block">
                            {{ $errors->first('end_date') }}
                        </p>
                    @endif
                </div>
            </div>
          
            <div class="row">
                <div class="col-xs-4 form-group">
                    {!! Form::label('facility_name', 'facility_name'.'*', ['class' => 'control-label']) !!}
                    {!! Form::text('facility_name', old('facility_name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('facility_name'))
                        <p class="help-block">
                            {{ $errors->first('facility_name') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-4 form-group">
                    {!! Form::label('issues_arising', 'issues_arising'.'*', ['class' => 'control-label']) !!}
                    {!! Form::textarea('issues_arising', old('issues_arising'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('issues_arising'))
                        <p class="help-block">
                            {{ $errors->first('issues_arising') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-4 form-group">
                    {!! Form::label('positive_findings', 'Positive Findings'.'*', ['class' => 'control-label']) !!}
                    {!! Form::textarea('positive_findings', old('positive_findings'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('positive_findings'))
                        <p class="help-block">
                            {{ $errors->first('positive_findings') }}
                        </p>
                    @endif
                </div>
            </div>
           
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('improvement_areas', 'improvement_areas'.'*', ['class' => 'control-label']) !!}
                    {!! Form::textarea('improvement_areas', old('improvement_areas'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('improvement_areas'))
                        <p class="help-block">
                            {{ $errors->first('improvement_areas') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-6 form-group">
                    {!! Form::label('recommendations', 'recommendations'.'*', ['class' => 'control-label']) !!}
                    {!! Form::textarea('recommendations', old('recommendations'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('recommendations'))
                        <p class="help-block">
                            {{ $errors->first('recommendations') }}
                        </p>
                    @endif
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                       Mentors
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Cadre</th>
                                <th>Phone</th>
                                <th>Email</th>
            
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody id="mentors">
                            @foreach(old('mentors', []) as $index => $data)
                                @include('admin.mentorships.add_mentorship_row', [
                                    'index' => $index
                                ])
                            @endforeach
                            </tbody>
                        </table>
                        <a href="#" class="btn btn-success pull-right add-new">@lang('quickadmin.qa_add_new')</a>
                    </div>
                </div>
                
                <div class="panel panel-default">
                    <div class="panel-heading">
                       Mentorship participants
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Cadre</th>
                                <th>Gender</th>
                                <th>Phone</th>
                                <th>Email</th>
            
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody id="mparticiants">
                            @foreach(old('mparticiants', []) as $index => $data)
                                @include('admin.mentorships.add_participants_row', [
                                    'index' => $index
                                ])
                            @endforeach
                            </tbody>
                        </table>
                        <a href="#" class="btn btn-success pull-right add-new">@lang('quickadmin.qa_add_new')</a>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent
   <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initialize" async defer></script>
   <script src="/adminlte/js/mapInput.js"></script>

    <script src="{{ url('adminlte/plugins/datetimepicker/moment-with-locales.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
    <script>
        $(function(){
            moment.updateLocale('{{ App::getLocale() }}', {
                week: { dow: 1 } // Monday is the first day of the week
            });
            
            $('.date').datetimepicker({
                format: "{{ config('app.date_format_moment') }}",
                locale: "{{ App::getLocale() }}",
            });
            
        });
    </script>
            
    <script src="{{ asset('quickadmin/plugins/fileUpload/js/jquery.iframe-transport.js') }}"></script>
    <script src="{{ asset('quickadmin/plugins/fileUpload/js/jquery.fileupload.js') }}"></script>
    
    <script type="text/html" id="mparticipants-template">
        @include('admin.mentorships.add_participants_row',
                [
                    'index' => '_INDEX_',
                ])
    </script >
    

    <script type="text/html" id="mentors-template">
        @include('admin.mentorships.add_mentorship_row',
                [
                    'index' => '_INDEX_',
                ])
    </script >

    

    <script>
        $('.add-new').click(function () {
            var tableBody = $(this).parent().find('tbody');
            var template = $('#' + tableBody.attr('id') + '-template').html();
            var lastIndex = parseInt(tableBody.find('tr').last().data('index'));
            if (isNaN(lastIndex)) {
                lastIndex = 0;
            }
            tableBody.append(template.replace(/_INDEX_/g, lastIndex + 1));
            return false;
        });
        $(document).on('click', '.remove', function () {
            var row = $(this).parentsUntil('tr').parent();
            row.remove();
            return false;
        });
    </script>
@stop


