@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.participant.title')</h3>
    @can('participant_create')
        <p>
            <button type="button" class="btn btn-info " data-toggle="modal" data-target="#NewPartsModal">Add Participants </button>


        </p>
    @endcan

    @can('participant_delete')
        <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.participants.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('quickadmin.qa_all')</a></li> |
            <li><a href="{{ route('admin.participants.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('quickadmin.qa_trash')</a></li>
        </ul>
        </p>
    @endcan


    <div class="box box-default">
        <div class="box-header">
            @lang('quickadmin.qa_list')
        </div>

        <div class="box-body table-responsive">
            <table class="table table-bordered table-striped {{ count($participants) > 0 ? 'datatable' : '' }} @can('participant_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                <tr>
                    @can('participant_delete')
                        @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                    @endcan

                    <th>@lang('quickadmin.participant.fields.pin')</th>

                    <th>@lang('quickadmin.participant.fields.first-name')</th>
                    <th>@lang('quickadmin.participant.fields.middle-name')</th>
                    <th>@lang('quickadmin.participant.fields.last-name')</th>
                    <th>@lang('quickadmin.participant.fields.mobile')</th>
                    <th>@lang('quickadmin.participant.fields.sex')</th>
                    <th>@lang('quickadmin.participant.fields.dob')</th>
                    <th>@lang('quickadmin.participant.fields.health-facility')</th>
                    <th>@lang('quickadmin.participant.fields.postal-address')</th>
                    <th>@lang('quickadmin.participant.fields.physical-addr')</th>
                    <th>@lang('quickadmin.participant.fields.district')</th>
                    <th>@lang('quickadmin.participant.fields.subcounty')</th>
                    <th>@lang('quickadmin.participant.fields.parish')</th>
                    <th>@lang('quickadmin.participant.fields.job-title')</th>
                    <th>@lang('quickadmin.participant.fields.profession')</th>
                    <th>@lang('quickadmin.participant.fields.previous-training')</th>
                    <th>@lang('quickadmin.participant.fields.education-level')</th>
                    <th>@lang('quickadmin.participant.fields.comments')</th>
                    <th>@lang('quickadmin.participant.fields.documents')</th>
                    <th>@lang('quickadmin.participant.fields.photo')</th>
                    @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                    @else
                        <th>&nbsp;</th>
                    @endif
                </tr>
                </thead>

                <tbody>
                @if (count($participants) > 0)
                    @foreach ($participants as $participant)
                        <tr data-entry-id="{{ $participant->id }}">
                            @can('participant_delete')
                                @if ( request('show_deleted') != 1 )<td></td>@endif
                            @endcan
                            <td field-key='first_name'>{{ $participant->pin }}</td>
                            <td field-key='first_name'>{{ $participant->first_name }}</td>
                            <td field-key='middle_name'>{{ $participant->middle_name }}</td>
                            <td field-key='last_name'>{{ $participant->last_name }}</td>
                            <td field-key='mobile'>{{ $participant->mobile }}</td>
                            <td field-key='sex'>{{ $participant->sex }}</td>
                            <td field-key='dob'>{{ $participant->dob }}</td>
                            <td field-key='health_facility'>{{ $participant->health_facility }}</td>
                            <td field-key='postal_address'>{{ $participant->postal_address }}</td>
                            <td field-key='physical_addr'>{{ $participant->physical_addr_address }}</td>
                            <td field-key='district'>{{ $participant->district }}</td>
                            <td field-key='subcounty'>{{ $participant->subcounty }}</td>
                            <td field-key='parish'>{{ $participant->parish }}</td>
                            <td field-key='job_title'>{{ $participant->job_title->name or '' }}</td>
                            <td field-key='profession'>{{ $participant->profession }}</td>
                            <td field-key='previous_training'>{{ $participant->previous_training }}</td>
                            <td field-key='education_level'>{{ $participant->education_level }}</td>
                            <td field-key='comments'>{!! $participant->comments !!}</td>
                            <td field-key='documents'> @foreach($participant->getMedia('documents') as $media)
                                    <p class="form-group">
                                        <a href="{{ $media->getUrl() }}" target="_blank">{{ $media->name }} ({{ $media->size }} KB)</a>
                                    </p>
                                @endforeach</td>
                            <td field-key='photo'>@if($participant->photo)<a href="{{ asset(env('UPLOAD_PATH').'/' . $participant->photo) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $participant->photo) }}"/></a>@endif</td>
                            @if( request('show_deleted') == 1 )
                                <td>
                                    @can('participant_delete')
                                        {!! Form::open(array(
        'style' => 'display: inline-block;',
        'method' => 'POST',
        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
        'route' => ['admin.participants.restore', $participant->id])) !!}
                                        {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                        {!! Form::close() !!}
                                    @endcan
                                    @can('participant_delete')
                                        {!! Form::open(array(
        'style' => 'display: inline-block;',
        'method' => 'DELETE',
        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
        'route' => ['admin.participants.perma_del', $participant->id])) !!}
                                        {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                    @endcan
                                </td>
                            @else
                                <td>
                                    @can('participant_view')
                                        <a href="{{ route('admin.participants.show',[$participant->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('participant_edit')
                                        <a href="{{ route('admin.participants.edit',[$participant->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('participant_delete')
                                        {!! Form::open(array(
                                                                                'style' => 'display: inline-block;',
                                                                                'method' => 'DELETE',
                                                                                'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                                                                'route' => ['admin.participants.destroy', $participant->id])) !!}
                                        {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                    @endcan
                                </td>
                            @endif
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="24">@lang('quickadmin.qa_no_entries_in_table')</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

<div id="NewPartsModal" class="modal fade" role="document">
    <div class="modal-dialog modal-lg ">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header modal-danger">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">New Participant</h4>
            </div>
            <div class="modal-body">
                <div class="box-default">
                    <div class="box-success">

                        train

                    </div>
                    <div class="box-body">

                        <form id="participant_form" method="post">
                            {{ csrf_field() }}
                            <div class="row">

                                <input type="hidden" name="training_id" value="{{$training}}">
                                <div class="col-xs-3 form-group" id="pin-form">
                                    {!! Form::label('pin', trans('quickadmin.participant.fields.pin').'*', ['class' => 'control-label']) !!}
                                    {!! Form::text('pin', old('pin'), ['class' => 'form-control','id'=>'pin', 'placeholder' => '', 'required' => '']) !!}

                                    <span class="help-block">
                                            <strong id="error-pin"></strong>
                                    </span>
                                </div>
                                <div class="col-xs-3 form-group" id="first_name-form">
                                    {!! Form::label('first_name', trans('quickadmin.participant.fields.first-name').'*', ['class' => 'control-label']) !!}
                                    {!! Form::text('first_name', old('first_name'), ['class' => 'form-control','id'=>'first_name', 'placeholder' => '', 'required' => '']) !!}
                                    <span class="help-block">
                                            <strong id="error-first_name"></strong>
                                    </span>
                                </div>
                                <div class="col-xs-3 form-group" id="middle_name-form">
                                    {!! Form::label('middle_name', trans('quickadmin.participant.fields.middle-name').'', ['class' => 'control-label']) !!}
                                    {!! Form::text('middle_name', old('middle_name'), ['class' => 'form-control','id'=>'middle_name', 'placeholder' => '']) !!}
                                    <span class="help-block">
                                            <strong id="error-middle_name"></strong>
                                    </span>
                                </div>
                                <div class="col-xs-3 form-group" id="last_name-form">
                                    {!! Form::label('last_name', trans('quickadmin.participant.fields.last-name').'', ['class' => 'control-label']) !!}
                                    {!! Form::text('last_name', old('last_name'), ['class' => 'form-control','id'=>'last_name', 'placeholder' => '']) !!}
                                    <span class="help-block">
                                            <strong id="error-last_name"></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="row">


                                <div class="col-xs-3 form-group" id="mobile-form">
                                    {!! Form::label('mobile', trans('quickadmin.participant.fields.mobile').'', ['class' => 'control-label']) !!}
                                    {!! Form::text('mobile', old('mobile'), ['class' => 'form-control','id'=>'mobile', 'placeholder' => '']) !!}
                                    <span class="help-block">
                                            <strong id="error-mobile"></strong>
                                    </span>
                                </div>
                                <div class="col-xs-3 form-group " id="sex-form">
                                    {!! Form::label('sex', trans('quickadmin.participant.fields.sex').'*', ['class' => 'control-label']) !!}
                                    {!! Form::select('sex', $enum_sex, old('sex'), ['class' => 'form-control select2','id'=>'sex', 'required' => '']) !!}
                                    <span class="help-block">
                                            <strong id="error-sex"></strong>
                                    </span>
                                </div>

                                <div class="col-xs-3 form-group" id="dob-form">
                                    {!! Form::label('dob', trans('quickadmin.participant.fields.dob').'', ['class' => 'control-label']) !!}
                                    {!! Form::date('dob', old('dob'), ['class' => 'form-control date','id'=>'dob', 'placeholder' => '']) !!}
                                    <span class="help-block">
                                            <strong id="error-dob"></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-3 form-group" id="heath_facility-form">
                                    {!! Form::label('health_facility', trans('quickadmin.participant.fields.health-facility').'', ['class' => 'control-label']) !!}
                                    {!! Form::text('health_facility', old('health_facility'), ['class' => 'form-control','id'=>'health_facility', 'placeholder' => '']) !!}
                                    <span class="help-block">
                                            <strong id="error-health_facility"></strong>
                                    </span>
                                </div>
                                <div class="col-xs-3 form-group" id="postal_address-form">
                                    {!! Form::label('postal_address', trans('quickadmin.participant.fields.postal-address').'', ['class' => 'control-label']) !!}
                                    {!! Form::text('postal_address', old('postal_address'), ['class' => 'form-control','id'=>'postal_address', 'placeholder' => '']) !!}
                                    <span class="help-block">
                                            <strong id="error-postal_address"></strong>
                                    </span>
                                </div>
                                <div class="col-xs-3 form-group" id="district-form">
                                    {!! Form::label('district', trans('quickadmin.participant.fields.district').'', ['class' => 'control-label']) !!}
                                    {!! Form::text('district', old('district'), ['class' => 'form-control','id'=>'district', 'placeholder' => 'district']) !!}
                                    <span class="help-block">
                                            <strong id="error-district"></strong>
                                    </span>
                                </div>
                                <div class="col-xs-3 form-group" id="subcounty-form">
                                    {!! Form::label('subcounty', trans('quickadmin.participant.fields.subcounty').'', ['class' => 'control-label']) !!}
                                    {!! Form::text('subcounty', old('subcounty'), ['class' => 'form-control','id'=>'subcounty', 'placeholder' => '']) !!}
                                    <span class="help-block">
                                            <strong id="error-subcounty"></strong>
                                    </span>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-xs-4 form-group">
                                    {!! Form::label('parish', trans('quickadmin.participant.fields.parish').'', ['class' => 'control-label']) !!}
                                    {!! Form::text('parish', old('parish'), ['class' => 'form-control','id'=>'', 'placeholder' => 'parish']) !!}
                                    <p class="help-block"></p>
                                    <span class="help-block">
                                            <strong id="error-parish"></strong>
                                    </span>
                                </div>

                                <div class="col-xs-4 form-group" id="job_title_id-form">
                                    {!! Form::label('job_title_id', trans('quickadmin.participant.fields.job-title').'', ['class' => 'control-label']) !!}
                                    {!! Form::select('job_title_id', $job_titles, old('job_title_id'), ['class' => 'form-control select2','id'=>'job_title_id']) !!}

                                    <span class="help-block">
                                            <strong id="error-job_title_id"></strong>
                                    </span>
                                </div>
                                <div class="col-xs-4 form-group" id="profession-form">
                                    {!! Form::label('profession', 'Cadre'.'', ['class' => 'control-label']) !!}
                                    {!! Form::text('profession', old('profession'), ['class' => 'form-control','id'=>'profession', 'placeholder' => '']) !!}
                                    <span class="help-block">
                                            <strong id="error-profession"></strong>
                                    </span>
                                </div>


                            </div>
                            <div class="row">

                                <div class="col-xs-3 form-group" id="education_level-form">
                                    {!! Form::label('education_level', trans('quickadmin.participant.fields.education-level').'', ['class' => 'control-label']) !!}
                                    <span class="help-block">
                                            <strong id="error-job_education_level"></strong>
                                    </span>
                                    <div>
                                        <label>
                                            {!! Form::radio('education_level', 'primary', false, ['id'=>'primary']) !!}
                                            P.I – P.7
                                        </label>
                                    </div>
                                    <div>
                                        <label>
                                            {!! Form::radio('education_level', 'olevel', false, ['id'=>'olevel']) !!}
                                            S.1 – S.4
                                        </label>
                                    </div>
                                    <div>
                                        <label>
                                            {!! Form::radio('education_level', 'alevel', false, ['id'=>'alevel']) !!}
                                            S.5 – S.6
                                        </label>
                                    </div><div>
                                        <label>
                                            {!! Form::radio('education_level', 'certificate', false, ['id'=>'certificate']) !!}
                                            S.5 – S.6
                                        </label>
                                    </div>
                                    <div>
                                        <label>
                                            {!! Form::radio('education_level', 'diploma', false, ['id'=>'diploma']) !!}
                                            Diploma
                                        </label>
                                    </div>
                                    <div>
                                        <label>
                                            {!! Form::radio('education_level', ' Degree', false, ['id'=>'degree']) !!}
                                            Degree
                                        </label>
                                    </div><div>
                                        <label>
                                            {!! Form::radio('education_level', ' Masters', false, ['id'=>'masters']) !!}
                                            Degree
                                        </label>
                                    </div>
                                    <div>
                                        <label>
                                            {!! Form::radio('education_level', 'other', false, ['id'=>'other']) !!}
                                            other
                                        </label>
                                    </div>

                                </div>
                                <div class="col-xs-3 form-group" id="comment-form">
                                    {!! Form::label('comments', trans('quickadmin.participant.fields.comments').'', ['class' => 'control-label']) !!}
                                    {!! Form::textarea('comments', old('comments'), ['class' => 'form-control ','rows' => 2, 'cols' => 10,'id'=>'comments', 'placeholder' => '']) !!}

                                    <span class="help-block">
                                            <strong id="error-comments"></strong>
                                    </span>
                                </div>
                                <div class="col-xs-3 form-group" id="prescore-form">
                                    {!! Form::label('prescore', 'prescore'.'', ['class' => 'control-label']) !!}
                                    {!! Form::text('prescore', old('prescore'), ['class' => 'form-control','id'=>'prescore', 'placeholder' => '']) !!}
                                    <span class="help-block">
                                            <strong id="error-prescore"></strong>
                                    </span>
                                </div>
                                <div class="col-xs-3 form-group" id="postscore-form">
                                    {!! Form::label('postscore', 'postscore'.'', ['class' => 'control-label']) !!}
                                    {!! Form::text('postscore', old('postscore'), ['class' => 'form-control','id'=>'', 'placeholder' => '']) !!}
                                    <span class="help-block">
                                            <strong id="error-postscore"></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="box box-info">
                                <div class="box-header">
                                    Previous trainings
                                </div>
                                <div class="box-body">
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
                                            @include('admin.trainings.prev_training_row', [
                                                'index' => $index
                                            ])
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <a href="#" class="btn btn-instagram pull-right add-new">@lang('quickadmin.qa_add_new')</a>
                                </div>
                            </div>

                            <button type="button" class="btn btn-link" data-dismiss="modal">Discard</button>
                            <button type="button" class="btn btn-success saveSchool"  onclick="saveParticipant()">Save Details</button>


                        </form>

                    </div>

                </div>

            </div>
            <div class="modal-footer">

            </div>
        </div>


    </div>
</div>

@section('javascript')
    <script>
        @can('participant_delete')
                @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.participants.mass_destroy') }}'; @endif
        @endcan

    </script>

    <script>
        var save_method; //for save method string
        //Function for saving the Work Experience
        function saveParticipant() {
            var url = "{{route('admin.trainings.saveParticipant')}}";
            var data = $("#participant_form").serialize();

            $('#pin-form').removeClass('has-error');
            $('#first_name-form').removeClass('has-error');
            $('#middle_name-form').removeClass('has-error');
            $('#last_name-form').removeClass('has-error');
            $('#mobile-form').removeClass('has-error');
            $('#sex-form').removeClass('has-error');
            $('#heath_facility-form').removeClass('has-error');
            $('#postal_address-form').removeClass('has-error');
            $('#district-form').removeClass('has-error');
            $('#subcounty-form').removeClass('has-error');
            $('#profession-form').removeClass('has-error');
            $('#comment-form').removeClass('has-error');
            $('#prescore-form').removeClass('has-error');
            $('#postscore-form').removeClass('has-error');


            $('#error-pin').html("");
            $('#error-first_name').html("");
            $('#error-middle_name').html("");
            $('#error-last_name').html("");
            $('#error-mobile').html("");
            $('#error-sex').html("");
            $('#error-health_facility').html("");
            $('#error-postal_address').html("");
            $('#error-district').html("");
            $('#error-subcounty').html("");
            $('#error-profession').html("");
            $('#error-comments').html("");
            $('#error-prescore').html("");
            $('#error-postscore').html("");

            //Ajax adding data to the database
            $.ajax({
                type: "POST",
                url: url,
                data: data,
                dataType: "JSON",
                success: function (data) {

                    if(data.errors)
                    {
                        if(data.errors.pin){
                            $('#pin-form').addClass('has-error');
                            $('#error-pin').html(data.errors.pin[0]);
                        }
                        if(data.errors.first_name){
                            $('#first_name-form').addClass('has-error');
                            $('#error-first_name').html(data.errors.first_name[0]);
                        }
                        if(data.errors.middle_name){
                            $('#middle_name-form').addClass('has-error');
                            $('#error-middle_name').html(data.errors.middle_name[0]);
                        }

                        if(data.errors.mobile){
                            $('#mobile-form').addClass('has-error');
                            $('#error-mobile').html(data.errors.mobile[0]);
                        }
                        if(data.errors.sex){
                            $('#sex-form').addClass('has-error');
                            $('#error-sex').html(data.errors.sex[0]);
                        }
                        if(data.errors.health_facility){
                            $('#heath_facility-form').addClass('has-error');
                            $('#error-health_facility').html(data.errors.health_facility[0]);
                        }
                        if(data.errors.postal_address){
                            $('#postal_address-form').addClass('has-error');
                            $('#error-postal_address').html(data.errors.postal_address[0]);
                        }
                        if(data.errors.district){
                            $('#district-form').addClass('has-error');
                            $('#error-district').html(data.errors.district[0]);
                        }
                        if(data.errors.subcounty){
                            $('#subcounty-form').addClass('has-error');
                            $('#error-subcounty').html(data.errors.subcounty[0]);
                        }
                        if(data.errors.profession){
                            $('#profession-form').addClass('has-error');
                            $('#error-profession').html(data.errors.subcounty[0]);
                        }
                        if(data.errors.comments){
                            $('#comment-form').addClass('has-error');
                            $('#error-comments').html(data.errors.subcounty[0]);
                        }
                        if(data.errors.prescore){
                            $('#prescore-form-form').addClass('has-error');
                            $('#error-prescore').html(data.errors.subcounty[0]);
                        }
                        if(data.errors.postscore){
                            $('#postscore-form-form').addClass('has-error');
                            $('#error-postscore').html(data.errors.subcounty[0]);
                        }
                    }

                    else {

                        console.log(data);



                        $('#participant_form')[0].reset();
                        $('#NewPartsModal').modal('hide');


                        location.reload();

                        toastr.success('Successfully added the Participant!', 'Success Alert', {timeOut: 5000});
                    }
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Warning: Error occurred while Saving the participant Records!!');
                }
            });

        }
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
@endsection