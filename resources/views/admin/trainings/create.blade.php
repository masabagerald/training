@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.training.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.trainings.store'], 'files' => true,]) !!}

    <div class="box box-success">
        <div class="box-header">
            @lang('quickadmin.qa_create')
        </div>


        <div class="col-xs-12 form-group">

        </div>


        
        <div class="box-body">
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('title', 'Title'.'*', ['class' => 'control-label']) !!}
                    {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('title'))
                        <p class="help-block">
                            {{ $errors->first('title') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-6 form-group">
                    {!! Form::label('type_of_training', trans('quickadmin.training.fields.type-of-training').'', ['class' => 'control-label']) !!}

                    {!! Form::select('type_of_training', $types, old('type_of_training'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('type_of_training'))
                        <p class="help-block">
                            {{ $errors->first('type_of_training') }}
                        </p>
                    @endif
                </div>

            </div>
            <div class="row">
                
                <div class="col-xs-6 form-group">
                    {!! Form::label('region', trans('quickadmin.training.fields.region').'', ['class' => 'control-label']) !!}
                    {!! Form::select('region', $regions, old('region'), ['class' => 'form-control select2', 'required' => '']) !!}
                     <p class="help-block"></p>
                    @if($errors->has('region'))
                        <p class="help-block">
                            {{ $errors->first('region') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-6 form-group">
                    {!! Form::label('venue', trans('quickadmin.training.fields.venue').'', ['class' => 'control-label']) !!}
                    {!! Form::text('venue', old('venue'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('venue'))
                        <p class="help-block">
                            {{ $errors->first('venue') }}
                        </p>
                    @endif
                </div>
            </div>


            <div class="row">
                <div class="col-xs-4 form-group">
                    {!! Form::label('start_date', trans('quickadmin.training.fields.start-date').'', ['class' => 'control-label']) !!}
                    {!! Form::text('start_date', old('start_date'), ['class' => 'form-control date', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('start_date'))
                        <p class="help-block">
                            {{ $errors->first('start_date') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-4 form-group">
                    {!! Form::label('end_date', trans('quickadmin.training.fields.end-date').'', ['class' => 'control-label']) !!}
                    {!! Form::text('end_date', old('end_date'), ['class' => 'form-control date', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('end_date'))
                        <p class="help-block">
                            {{ $errors->first('end_date') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-4 form-group">
                    {!! Form::label('sponsor', trans('quickadmin.training.fields.sponsor').'', ['class' => 'control-label']) !!}
                    {!! Form::text('sponsor', old('sponsor'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('sponsor'))
                        <p class="help-block">
                            {{ $errors->first('sponsor') }}
                        </p>
                    @endif
                </div>

            </div>

            <div class="row">

                {{--<div class="col-xs-6 form-group">
                    {!! Form::label('comments', trans('quickadmin.training.fields.comments').'', ['class' => 'control-label']) !!}
                    {!! Form::textarea('comments', old('comments'), ['class' => 'form-control editor', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('comments'))
                        <p class="help-block">
                            {{ $errors->first('comments') }}
                        </p>
                    @endif
                </div>--}}
            </div>

            {{--<div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('pictures', trans('quickadmin.training.fields.pictures').'', ['class' => 'control-label']) !!}
                    {!! Form::file('pictures[]', [
                        'multiple',
                        'class' => 'form-control file-upload',
                        'data-url' => route('admin.media.upload'),
                        'data-bucket' => 'pictures',
                        'data-filekey' => 'pictures',
                        ]) !!}
                    <p class="help-block"></p>
                    <div class="photo-block">
                        <div class="progress-bar form-group">&nbsp;</div>
                        <div class="files-list"></div>
                    </div>
                    @if($errors->has('pictures'))
                        <p class="help-block">
                            {{ $errors->first('pictures') }}
                        </p>
                    @endif
                </div>
            </div>--}}
            
        </div>


    </div>
    {!! Form::submit(trans('quickadmin.qa_save').' & exit', ['class' => ' btn btn-info','value'=>'save','name'=>'action_button']) !!}
    {!! Form::submit('Save & Add participants', ['class' => ' btn btn-success','value'=>'save_add','name'=>'action_button']) !!}
    {!! Form::close() !!}




@stop

@section('javascript')
    @parent
    <script src="//cdn.ckeditor.com/4.5.4/full/ckeditor.js"></script>
    <script>
        $('.editor').each(function () {
                  CKEDITOR.replace($(this).attr('id'),{
                    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
                    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
            });
        });
    </script>

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
                        model_name: 'Training',
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
@stop