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
                <div class="col-xs-7 form-group">
                    {!! Form::label('title', trans('quickadmin.roles.fields.title').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('title'))
                        <p class="help-block">
                            {{ $errors->first('title') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-5 form-group">
                  
                    {!! Form::label('category', 'Category'.'*', ['class' => 'control-label']) !!}
                    {!! Form::select('category', $categories, old('category'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('category'))
                        <p class="help-block">
                            {{ $errors->first('category') }}
                        </p>
                    @endif
                </div>
               
            </div>
            <div class="row">
                
                <div class="col-xs-4 form-group">
                    {!! Form::label('srart_date', 'Start Date'.'*', ['class' => 'control-label']) !!}
                    {!! Form::text('srart_date', old('srart_date'), ['class' => 'form-control date', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('srart_date'))
                        <p class="help-block">
                            {{ $errors->first('srart_date') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-4 form-group">
                    {!! Form::label('end_date', 'End Date'.'*', ['class' => 'control-label']) !!}
                    {!! Form::text('end_date', old('end_date'), ['class' => 'form-control date', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('end_date'))
                        <p class="help-block">
                            {{ $errors->first('end_date') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-4 form-group">
                    {!! Form::label('facility_name', 'Venue'.'*', ['class' => 'control-label']) !!}
                    {!! Form::select('facility_name', $facilities, old('facility_name'), ['class' => 'form-control select2', 'required' => '']) !!}
                  
                    <p class="help-block"></p>
                    @if($errors->has('facility_name'))
                        <p class="help-block">
                            {{ $errors->first('facility_name') }}
                        </p>
                    @endif
                </div>
            </div>
          
            
           
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_save').' & exit', ['class' => ' btn btn-info','value'=>'save','name'=>'action_button']) !!}
    {!! Form::submit('Save & Add participants', ['class' => ' btn btn-success','value'=>'save_add','name'=>'action_button']) !!}

    
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


