@extends('layouts.app')

@section('content')

    <div class="box box-info">
        <div class="box box-header">
            Search Participant
        </div>

        <div class="box-body">

            <form action="{{route('admin.trainings.search')}}">

                <div class="row">
                    <div class="col-xs-3 form-group">

                        {!! Form::text('pin', old('pin'), ['class' => 'form-control', 'placeholder' => 'pin', 'required' => '']) !!}



                    </div>
                    <div class="col-xs-1 form-group">
                        {!! Form::label('or', 'or', ['class' => 'control-label']) !!}




                    </div>

                    <div class="col-xs-4 form-group">

                        {!! Form::text('first_name', old('first_name'), ['class' => 'form-control', 'placeholder' => 'name']) !!}

                    </div>
                    <div class="col-xs-4 form-group">


                  <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat">Search <i class="fa fa-search"></i>
                </button>
              </span>
                    </div>
                </div>

            </form>

        </div>


        <div class="row">
            &nbsp;

        </div>

    </div>

    <h3 class="page-title">@lang('quickadmin.participant.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.participants.store'], 'files' => true,]) !!}



       &nbsp;




    <div class="box box-success">
        <div class="box box-header">
           New participant
        </div>

        <div class="box-body">
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('pin', trans('quickadmin.participant.fields.pin').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('pin', old('pin'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('pin'))
                        <p class="help-block">
                            {{ $errors->first('pin') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-6 form-group">
                    {!! Form::label('first_name', trans('quickadmin.participant.fields.first-name').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('first_name', old('first_name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('first_name'))
                        <p class="help-block">
                            {{ $errors->first('first_name') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('middle_name', trans('quickadmin.participant.fields.middle-name').'', ['class' => 'control-label']) !!}
                    {!! Form::text('middle_name', old('middle_name'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('middle_name'))
                        <p class="help-block">
                            {{ $errors->first('middle_name') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-6 form-group">
                    {!! Form::label('last_name', trans('quickadmin.participant.fields.last-name').'', ['class' => 'control-label']) !!}
                    {!! Form::text('last_name', old('last_name'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('last_name'))
                        <p class="help-block">
                            {{ $errors->first('last_name') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('mobile', trans('quickadmin.participant.fields.mobile').'', ['class' => 'control-label']) !!}
                    {!! Form::text('mobile', old('mobile'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('mobile'))
                        <p class="help-block">
                            {{ $errors->first('mobile') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-6 form-group">
                    {!! Form::label('sex', trans('quickadmin.participant.fields.sex').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('sex', $enum_sex, old('sex'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('sex'))
                        <p class="help-block">
                            {{ $errors->first('sex') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('dob', trans('quickadmin.participant.fields.dob').'', ['class' => 'control-label']) !!}
                    {!! Form::text('dob', old('dob'), ['class' => 'form-control date', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('dob'))
                        <p class="help-block">
                            {{ $errors->first('dob') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-6 form-group">
                    {!! Form::label('health_facility', trans('quickadmin.participant.fields.health-facility').'', ['class' => 'control-label']) !!}
                    {!! Form::text('health_facility', old('health_facility'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('health_facility'))
                        <p class="help-block">
                            {{ $errors->first('health_facility') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('postal_address', trans('quickadmin.participant.fields.postal-address').'', ['class' => 'control-label']) !!}
                    {!! Form::text('postal_address', old('postal_address'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('postal_address'))
                        <p class="help-block">
                            {{ $errors->first('postal_address') }}
                        </p>
                    @endif
                </div>
                {{--<div class="col-xs-6 form-group">
                    {!! Form::label('physical_addr_address', trans('quickadmin.participant.fields.physical-addr').'', ['class' => 'control-label']) !!}
                    {!! Form::text('physical_addr_address', old('physical_addr_address'), ['class' => 'form-control map-input', 'id' => 'physical_addr-input']) !!}
                    {!! Form::hidden('physical_addr_latitude', 0 , ['id' => 'physical_addr-latitude']) !!}
                    {!! Form::hidden('physical_addr_longitude', 0 , ['id' => 'physical_addr-longitude']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('physical_addr'))
                        <p class="help-block">
                            {{ $errors->first('physical_addr') }}
                        </p>
                    @endif
                </div>--}}
            </div>

{{--
            <div id="physical_addr-map-container" style="width:100%;height:200px; ">
                <div style="width: 100%; height: 100%" id="physical_addr-map"></div>
            </div>
            @if(!env('GOOGLE_MAPS_API_KEY'))
                <b>'GOOGLE_MAPS_API_KEY' is not set in the .env</b>
            @endif--}}

            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('district', trans('quickadmin.participant.fields.district').'', ['class' => 'control-label']) !!}
                    {!! Form::text('district', old('district'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('district'))
                        <p class="help-block">
                            {{ $errors->first('district') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-6 form-group">
                    {!! Form::label('subcounty', trans('quickadmin.participant.fields.subcounty').'', ['class' => 'control-label']) !!}
                    {!! Form::text('subcounty', old('subcounty'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('subcounty'))
                        <p class="help-block">
                            {{ $errors->first('subcounty') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('parish', trans('quickadmin.participant.fields.parish').'', ['class' => 'control-label']) !!}
                    {!! Form::text('parish', old('parish'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('parish'))
                        <p class="help-block">
                            {{ $errors->first('parish') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-6 form-group">
                    {!! Form::label('job_title_id', trans('quickadmin.participant.fields.job-title').'', ['class' => 'control-label']) !!}
                    {!! Form::select('job_title_id', $job_titles, old('job_title_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('job_title_id'))
                        <p class="help-block">
                            {{ $errors->first('job_title_id') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('profession', trans('quickadmin.participant.fields.profession').'', ['class' => 'control-label']) !!}
                    {!! Form::text('profession', old('profession'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('profession'))
                        <p class="help-block">
                            {{ $errors->first('profession') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-6 form-group">
                    {!! Form::label('previous_training', trans('quickadmin.participant.fields.previous-training').'', ['class' => 'control-label']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('previous_training'))
                        <p class="help-block">
                            {{ $errors->first('previous_training') }}
                        </p>
                    @endif
                    <div>
                        <label>
                            {!! Form::radio('previous_training', '1', false, []) !!}
                            yes
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('previous_training', '0', false, []) !!}
                            no
                        </label>
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('education_level', trans('quickadmin.participant.fields.education-level').'', ['class' => 'control-label']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('education_level'))
                        <p class="help-block">
                            {{ $errors->first('education_level') }}
                        </p>
                    @endif
                    <div>
                        <label>
                            {!! Form::radio('education_level', '1', false, []) !!}
                            P.I – P.7
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('education_level', '2', false, []) !!}
                            S.1 – S.4
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('education_level', '3', false, []) !!}
                            S.5 – S.6
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('education_level', '4', false, []) !!}
                            Diploma
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('education_level', '5', false, []) !!}
                            Degree
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('education_level', '6', false, []) !!}
                            other
                        </label>
                    </div>

                </div>
                <div class="col-xs-6 form-group">
                    {!! Form::label('comments', trans('quickadmin.participant.fields.comments').'', ['class' => 'control-label']) !!}
                    {!! Form::textarea('comments', old('comments'), ['class' => 'form-control ', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('comments'))
                        <p class="help-block">
                            {{ $errors->first('comments') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('documents', trans('quickadmin.participant.fields.documents').'', ['class' => 'control-label']) !!}
                    {!! Form::file('documents[]', [
                        'multiple',
                        'class' => 'form-control file-upload',
                        'data-url' => route('admin.media.upload'),
                        'data-bucket' => 'documents',
                        'data-filekey' => 'documents',
                        ]) !!}
                    <p class="help-block"></p>
                    <div class="photo-block">
                        <div class="progress-bar form-group">&nbsp;</div>
                        <div class="files-list"></div>
                    </div>
                    @if($errors->has('documents'))
                        <p class="help-block">
                            {{ $errors->first('documents') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-6 form-group">
                    {!! Form::label('photo', trans('quickadmin.participant.fields.photo').'', ['class' => 'control-label']) !!}
                    {!! Form::file('photo', ['class' => 'form-control', 'style' => 'margin-top: 4px;']) !!}
                    {!! Form::hidden('photo_max_size', 2) !!}
                    {!! Form::hidden('photo_max_width', 4096) !!}
                    {!! Form::hidden('photo_max_height', 4096) !!}
                    <p class="help-block"></p>
                    @if($errors->has('photo'))
                        <p class="help-block">
                            {{ $errors->first('photo') }}
                        </p>
                    @endif
                </div>
            </div>


        </div>
    </div>


    <div class="panel panel-default">
        <div class="panel-heading">
           Previous trainings
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Training</th>
                    <th>Date</th>
                    <th>Organization</th>

                    <th>Actions</th>
                </tr>
                </thead>
                <tbody id="participant">
                @foreach(old('particiants', []) as $index => $data)
                    @include('admin.participants.prev_training_row', [
                        'index' => $index
                    ])
                @endforeach
                </tbody>
            </table>
            <a href="#" class="btn btn-success pull-right add-new">@lang('quickadmin.qa_add_new')</a>
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
    <script>
        $(function () {
            $('.file-upload').each(function () {
                var $this = $(this);
                var $parent = $(this).parent();

                $(this).fileupload({
                    dataType: 'json',
                    formData: {
                        model_name: 'Participant',
                        bucket: $this.data('bucket'),
                        file_key: $this.data('filekey'),
                        _token: '{{ csrf_token() }}'
                    },
                    add: function (e, data) {
                        data.submit();
                    },
                    done: function (e, data) {
                        $.each(data.result.files, function (index, file) {
                            var $line = $($('<p/>', {class: "form-group"}).html(file.name + ' (' + file.size + ' bytes)').appendTo($parent.find('.files-list')));
                            $line.append('<a href="#" class="btn btn-xs btn-danger remove-file">Remove</a>');
                            $line.append('<input type="hidden" name="' + $this.data('bucket') + '_id[]" value="' + file.id + '"/>');
                            if ($parent.find('.' + $this.data('bucket') + '-ids').val() != '') {
                                $parent.find('.' + $this.data('bucket') + '-ids').val($parent.find('.' + $this.data('bucket') + '-ids').val() + ',');
                            }
                            $parent.find('.' + $this.data('bucket') + '-ids').val($parent.find('.' + $this.data('bucket') + '-ids').val() + file.id);
                        });
                        $parent.find('.progress-bar').hide().css(
                            'width',
                            '0%'
                        );
                    }
                }).on('fileuploadprogressall', function (e, data) {
                    var progress = parseInt(data.loaded / data.total * 100, 10);
                    $parent.find('.progress-bar').show().css(
                        'width',
                        progress + '%'
                    );
                });
            });
            $(document).on('click', '.remove-file', function () {
                var $parent = $(this).parent();
                $parent.remove();
                return false;
            });
        });
    </script>

    <script type="text/html" id="participant-template">
        @include('admin.participants.prev_training_row',
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
