@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">

    <h3 class="page-title">@lang('quickadmin.training.title') Summary</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-4">
                    <table class="table  table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.training.fields.type-of-training')</th>
                            <td field-key='type_of_training'>{{ $training->type->name or ''}}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.training.fields.region')</th>
                            <td field-key='region'>{{ $training->region }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.training.fields.venue')</th>
                            <td field-key='venue'>{{ $training->venue }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.training.fields.start-date')</th>
                            <td field-key='start_date'>{{ $training->start_date }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.training.fields.end-date')</th>
                            <td field-key='end_date'>{{ $training->end_date }}</td>
                        </tr>

                        <tr>
                            <th>@lang('quickadmin.training.fields.sponsor')</th>
                            <td field-key='sponsor'>{{ $training->sponsor }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.training.fields.comments')</th>
                            <td field-key='comments'>{!! $training->comments !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.training.fields.pictures')</th>
                            <td field-key='pictures'> @foreach($training->getMedia('pictures') as $media)
                                <p class="form-group">
                                    <a href="{{ $media->getUrl() }}" target="_blank">{{ $media->name }} ({{ $media->size }} KB)</a>
                                </p>
                            @endforeach</td>
                        </tr>
                    </table>

                </div>
                <div class="col-md-8">

                    <div class="box box-info">
                        <div class="box-header">
                            <div class="row">
                                <div class="col-md-6">
                                    Participants for {{$training->type->name or ''."(".$training->start_date." to ".$training->end_date.")"}}
                                </div>
                                <div class="col-md-6">
                                    <button data-toggle="modal" data-target="#NewPartsModal" class="btn btn-success fa fa-plus pull-right">Add</button>
                                </div>

                            </div>


                        </div>
                        <div class="box-body table-responsive">
                            <table class="table table-bordered table-striped datatable">
                                <thead>
                                <tr>

                                    <th>@lang('quickadmin.participant.fields.pin')</th>

                                    <th>@lang('quickadmin.participant.fields.first-name')</th>
                                    <th>@lang('quickadmin.participant.fields.middle-name')</th>
                                    <th>@lang('quickadmin.participant.fields.last-name')</th>
                                    <th>@lang('quickadmin.participant.fields.mobile')</th>
                                    <th>@lang('quickadmin.participant.fields.sex')</th>
                                    <th>@lang('quickadmin.participant.fields.dob')</th>
                                    <th>@lang('quickadmin.participant.fields.health-facility')</th>
                                    <th>Pretest score</th>
                                    <th>Postest score</th>
                                    <th>Action</th>

                                </tr>
                                </thead>
                                <tbody>
                                @if (count($participants) > 0)
                                    @foreach ($participants as $participant)
                                        <tr data-entry-id="{{ $participant->id }}">


                                            <td field-key='first_name'>{{ $participant->pin }}</td>
                                            <td field-key='first_name'>{{ $participant->first_name }}</td>
                                            <td field-key='middle_name'>{{ $participant->middle_name }}</td>
                                            <td field-key='last_name'>{{ $participant->last_name }}</td>
                                            <td field-key='mobile'>{{ $participant->mobile }}</td>
                                            <td field-key='sex'>{{ $participant->sex }}</td>
                                            <td field-key='dob'>{{ $participant->dob }}</td>
                                            <td field-key='health_facility'>{{ $participant->pivot->facility }}</td>
                                            <td field-key='health_facility'>{{ $participant->pivot->pre_test }}</td>
                                            <td field-key='health_facility'>{{ $participant->pivot->post_test }}</td>
                                            <td>
                                                @can('participant_view')
                                                    <a href="" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                                @endcan
                                                @can('participant_edit')

                                                    <a href="" data-toggle="modal" id="editlink"  data-target="#editparts"\
                                                       data-name="{{$participant->first_name.' '. $participant->last_name}}"
                                                       data-id="{{$participant->id}}" data-pin="{{$participant->pin}}" data-facility="{{$participant->health_facility }}"
                                                       data-pre="{{$participant->pivot->pre_test}}" data-post="{{ $participant->pivot->post_test }}"
                                                       class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
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

                        <div class="box-footer">
                            <button id="a_add" data-toggle="modal" data-target="#attachModal" data-id="{{$training->id}}"  data-name="{{$training->type->name or ''}}" class="btn btn-circle">
                                <span>Attach Participant scores</span>

                            </button>



                        </div>




                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="box box-success">
                        <div class="box box-header">

                            Upload Participants

                        </div>
                        <div class="box-body">

                            <form class="md-form" method="post" action="{{route('admin.trainings.uploadExcel')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="file-field ">
                                    <input type="hidden" name="training_id" value="{{$training->id}}">
                                    <div class="btn btn-rounded peach-gradient btn-lg float-left">
                                        <span class="text-info">Choose excel file</span>
                                        <input type="file" name="participants" class="form-control">
                                    </div>


                                            <input type="submit" value="Upload" class="btn btn-success">



                                </div>
                            </form>

                        </div>

                    </div>

                </div>
                <div class="col-md-6">

                    <div class="box box-info">
                        <div class="box-header">
                            Adding Participants

                        </div>

                        <div class="box-body">

                            <form action="" method="post">
                                {{ csrf_field() }}

                                <input type="hidden" name="id" value="{{$training->id}}">

                                <label>Please select participants</label>

                                <select name="students[]" class="form-control select2" multiple required="">
                                    @foreach($all_participants as $participant)

                                        <option value="{{$participant->id}}">{{$participant->first_name." ".$participant->last_name."(".$participant->pin.")"}}</option>

                                    @endforeach
                                </select>

                                <input type="submit" class="btn btn-success" value="Add Participants">


                            </form>


                        </div>


                    </div>



                </div>



            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.trainings.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>


    <!--=========================== Modal to Add new  Participants to the selected Training ==============================================-->


    <div id="NewPartsModal" class="modal fade" role="document">
        <div class="modal-dialog modal-lg ">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header modal-danger">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">New Participant</h4>
                </div>
                <div class="modal-body">
                    <div id="message" class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>

                    <div class="box-default">
                        <div class="box-success">

                            train

                        </div>
                        <div class="box-body">

                            <form id="participant_form" method="post">
                                {{ csrf_field() }}
                                <div class="row">

                                    <input type="hidden" name="training_id" id="training_id" value="{{$training->id}}">


                                    <div class="col-xs-3 form-group" id="pin-form">
                                        {!! Form::label('pin', trans('quickadmin.participant.fields.pin').'*', ['class' => 'control-label']) !!}
                                        {!! Form::text('pin', old('pin'), ['class' => 'form-control','id'=>'pin', 'placeholder' => '', 'required' => '']) !!}

                                        <span class="help-block">
                                            <div id="error-pin"></div>
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
                                        {!! Form::label('nin', 'Nin'.'', ['class' => 'control-label']) !!}
                                        {!! Form::text('nin', old('nin'), ['class' => 'form-control','id'=>'nin', 'placeholder' => 'nin','maxlength'=>10]) !!}
                                        <span class="help-block">
                                            <strong id="error-nin"></strong>
                                    </span>
                                    </div>



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
                                        {!! Form::select('health_facility', $facilities, old('health_facility'), ['class' => 'form-control select2']) !!}
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
                                               Certificate
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
                                               Masters
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

    <!--=========================== Modal to Attach Participants to the selected Training ==============================================-->
    <div id="attachModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Participant</h4>
                </div>
                <div class="modal-body">
                   <div class="box box-info">
                       <div class="box box-header">
                            Attaching Participant
                       </div>
                       <div class="box box-body">
                           <form id="part_form" method="POST" >

                               {{ csrf_field() }}
                               <div class="row">

                                       <div class="col-md-6  form-group">
                                           <label class="control-label">Training</label>
                                           <input type="hidden" value="{{$training->id}}" name="training_id" placeholder="{{$training->id}}" >

                                           <input type="text"  class="form-control"  placeholder="{{$training->type->name}}" readonly>

                                       </div>

                                   <input type="hidden" name="pin" id="p_pin" >
                                   <input type="hidden" name="participant_id" id="participant_id">





                                   <div class="col-md-6 form-group">
                                       <label class="control-label">Participant</label>
                                       <input type="text" name="a_training" id="a_part" class="form-control"  readonly>

                                       {{--{!! Form::select('participant_id', $all_participants, old('participant_id'), ['class' => 'form-control select2','id'=>'a_participant']) !!}--}}

                                   </div>


                               </div>


                               <div class="row">
                                   <div class="col-md-6 form-group">
                                       <label class="control-label">Pre test score</label>



                                       <input type="text" name="a_pre" id=a_pre"" class="form-control" placeholder="pre-test score">


                                   </div>
                                   <div class="col-md-6 form-group">
                                       <label class="control-label">Post Test Score</label>

                                           <input type="text" name="a_post" id="a_post" class="form-control" placeholder="post-test score">


                                   </div>

                               </div>
                               <div class="row">
                                   <div class="col-md-6 form-group" >
                                       {!! Form::label('job_title_id', trans('quickadmin.participant.fields.job-title').'', ['class' => 'control-label']) !!}
                                       {!! Form::select('position', $job_titles, old('position'), ['class' => 'form-control select2']) !!}

                                       <span class="help-block">
                                            <strong id="error-job_title_id"></strong>
                                    </span>
                                   </div>
                                   <div class="col-md-6 form-group">
                                       <label class="control-label">Comment</label>

                                       <textarea name="a_comment" id="a_comment" class="form-control" rows="4" cols="50"></textarea>

                               </div>

                               <div class="row">
                                   <div class="col-md-6">
                                       <button type="button" class="btn btn-reddit" data-dismiss="modal">Close</button>
                                   </div>
                                   <div class="col-md-6">
                                       <button type="button" class="btn btn-instagram" id="p_attach" onclick="gradeParticipant()">
                                           Submit
                                       </button>
                                   </div>
                               </div>
                               </div>

                           </form>

                       </div>

                   </div>

                </div>
                <div class="modal-footer">

                </div>
            </div>

        </div>
    </div>

    <!--=========================== Modal to edit participants ==============================================-->
    <div id="editparts" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Participant</h4>
                </div>
                <div class="modal-body">
                    <div class="box box-info">
                        <div class="box box-header">
                        </div>
                        <div class="box box-body">
                            <form id="update_form" method="POST" >

                                 {{ csrf_field() }}
                                <div class="row">

                                    <div class="col-md-6  form-group">
                                        <label class="control-label">Training</label>
                                        <input type="hidden" value="{{$training->id}}" name="training_id" placeholder="{{$training->id}}" >

                                        <input type="text"  class="form-control"  placeholder="{{$training->type->name}}" readonly>

                                    </div>

                                    <input type="hidden" name="pin" id="p_pin" >
                                    <input type="hidden" name="participant_id" id="edit_part_id">





                                    <div class="col-md-6 form-group">
                                        <label class="control-label">Participant</label>
                                        <input type="text" name="edit_participant" id="edit_participant" class="form-control"  readonly>

                                        {{--{!! Form::select('participant_id', $all_participants, old('participant_id'), ['class' => 'form-control select2','id'=>'a_participant']) !!}--}}

                                    </div>


                                </div>



                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label class="control-label">Pin</label>

                                        <input type="text" name="edit_pin" id="edit_pin" readonly class="form-control">
                                    </div>
                                    <div class="col-md-6 form-group" >
                                        {!! Form::label('job_title_id', trans('quickadmin.participant.fields.job-title').'', ['class' => 'control-label']) !!}
                                        {!! Form::select('edit_position', $job_titles, old('position'), ['class' => 'form-control select2']) !!}

                                        <span class="help-block">
                                            <strong id="error-job_title_id"></strong>
                                    </span>
                                    </div>




                                </div>
                                <div class="row">

                                    <div class="col-md-6 form-group">
                                        <label class="control-label">Health Facility</label>

                                        <input type="text" name="edit_facility" id="edit_facility" class="form-control">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label class="control-label">Comment</label>

                                        <textarea name="edit_comment" id="edit_comment" class="form-control" rows="3" cols="50"></textarea>

                                    </div>



                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label class="control-label">Pre test score</label>



                                        <input type="text" name="edit_pre" id="edit_pre" class="form-control" placeholder="pre-test score">


                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label class="control-label">Post Test Score</label>

                                        <input type="text" name="edit_post" id="edit_post" class="form-control" placeholder="post-test score">


                                    </div>

                                </div>



                                    <div class="row">
                                        <div class="col-md-6">
                                            <button type="button" class="btn btn-reddit" data-dismiss="modal">Close</button>
                                        </div>
                                        <div class="col-md-6">
                                            <button type="button" class="btn btn-instagram" id="edit_button" onclick="updateParticipant()">
                                                update
                                            </button>
                                        </div>

                                    </div>
                            </form>
                                </div>



                        </div>
                    </div>
                </div>

                        ...
            </div>
        </div>
    </div>
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
    <script>
        var save_method;


        $(document).on('click', '#a_add', function() {

           // $('#a_training').val(data.id);
            $('#a_training').val($(this).data('name'));
            $('#a_hidden').val($(this).data('id'));

        });


        //for save method string
        //Function for saving the Work Experience
    function attachParticipant() {

            $('#a_training').val($(this).data('id'));

            var url = "{{route('admin.trainings.attachparts')}}";
            var data = $("#a_form").serialize();

            console.log(data);
            //Ajax adding data to the database
            $.ajax({
                type: "POST",
                url: url,
                data: data,
                dataType: "JSON",
                success: function (data) {

                    if(data.errors)
                    {


                        toastr.error(data.errors);
                    }

                    else {

                        $('#a_form')[0].reset();
                        $('#attachModal').modal('hide');
                        location.reload();

                        toastr.success('Successfully attached Participants to the training!', 'Success Alert', {timeOut: 5000});
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
    <script>
        $(document).ready(function(){
            $("#pin").blur(function(){

                $('#a_training').val($(this).data('fname'));
                //$('#a_hidden').val($(this).data('id'));

                var participant_pin = $('#pin').val();
                var participant_name = 'masaba';

                var url = "{{route('admin.participants.check_userpin')}}";
                console.log(participant_pin);


                $.ajax({

                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: url,
                    data: {participant_pin: participant_pin, _token: '{{csrf_token()}}'},
                    dataType: "Json",

                    success: function(data){
                        if(data == null){

                            alert('nothing');
                            console.log('nothing');

                        } else {

                            console.log(data);

                            var fname = data.first_name;
                            var lname = data.last_name;
                            var participant_id = data.id;
                            var pin = participant_pin;
                            var training_id=1;
                            var training='string';

                            $('#error-pin').html(" <span><a data-toggle=\"modal\" id=\"p_attach\" href=\"#attachModal\" data-fname='"+fname+"' data-lname='"+lname+"' data-pin='"+pin+"' data-partid='"+participant_id+"'>Participant already exists</a> </span>")

                        }
                    }
                });

            });
        });
    </script>

    <script>
        var save_method;


        $(document).on('click', '#p_attach', function() {

            // $('#a_training').val(data.id);
            $('#a_part').val($(this).data('fname')+' '+$(this).data('lname' ));
            $('#a_hidden').val($(this).data('id'));
            $('#p_pin').val($(this).data('pin'));
            $('#participant_id').val($(this).data('partid'));



        });



        function gradeParticipant() {

            $('#a_training').val($(this).data('id'));

            var url = "{{route('admin.trainings.gradeparts')}}";
            var data = $("#part_form").serialize();

            console.log(data);
            //Ajax adding data to the database
            $.ajax({
                type: "POST",
                url: url,
                data: data,
                dataType: "JSON",
                success: function (data) {

                    if(data.errors)
                    {
                        toastr.error(data.errors);
                    }

                    else {

                        //$('#a_form')[0].reset();
                        $('#part_form')[0].reset();


                        $('#attachModal').modal('hide');
                        $('#NewPartsModal').modal('hide');
                        location.reload();

                        toastr.success('Successfully attached Participants to the training!', 'Success Alert', {timeOut: 5000});
                    }
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert(errorThrown);
                }
            });

        }
    </script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
    <script type="text/javascript">

        var jq = $.noConflict();
        jq.ready(function($) {

            $('#search').multiselect({
                search: {
                    left: '<input type="text" name="q" class="form-control" placeholder="Search..." />',
                    right: '<input type="text" name="q" class="form-control" placeholder="Search..." />',
                },
                fireSearch: function(value) {
                    return value.length > 3;
                }
            });
        });
    </script>

    <script>
       // data-id data-facility data-pre data-post

        $(document).on('click', '#editlink', function() {

        // $('#a_training').val(data.id);
       // $('#a_training').val($(this).data('id'));


        $('#edit_pre').val($(this).data('post'));
        $('#edit_post').val($(this).data('post'));
        $('#edit_participant').val($(this).data('name'));
        $('#edit_facility').val($(this).data('facility'));
        $('#edit_part_id').val($(this).data('id'));
        $('#edit_pin').val($(this).data('pin'));



        });



        //for save method string
        //Function for saving the Work Experience
        function updateParticipant() {

           // $('#a_training').val($(this).data('id'));

            var url = "{{route('admin.trainings.updatepivot')}}";
            var data = $("#update_form").serialize();

			console.log(url);

            console.log(data);
            //Ajax adding data to the database
            $.ajax({
                type: "POST",
                url: url,
                data: data,
                dataType: "JSON",
                success: function (data) {

                    if (data.errors) {


                        toastr.error(data.errors);
                    }

                    else {

                        $('#update_form')[0].reset();
                        $('#editparts').modal('hide');
                        location.reload();

                        toastr.success('Successfully updated participants!', 'Success Alert', {timeOut: 5000});
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert('Warning: Error occurred while updating the participant details!!');
                }
            })
        }

    </script>
            
@stop
