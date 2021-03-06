@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">

    <h3 class="page-title">Mentorship Summary Page</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>
        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-4">
                    <table class="table  table-bordered table-striped">
                        <tr>
                            <th>Name</th>
                            <td field-key='type_of_training'>{{ $training->title}}</td>
                        </tr>
                        <tr>
                            <th>Category</th>
                            <td field-key='type_of_training'>{{ $training->mentorship_category->name}}</td>
                        </tr>
                        <tr>
                            <th>Start Date</th>
                            <td field-key='region'>{{ $training->srart_date }}</td>
                        </tr>
                        <tr>
                            <th>End Date</th>
                            <td field-key='venue'>{{ $training->end_date }}</td>
                        </tr>
                        <tr>
                            <th>Facility</th>
                            <td field-key='start_date'>{{ $training->facility->name }}</td>
                        </tr>
                        <tr>
                            <th>Issues Arising</th>
                            <td field-key='end_date'>{{ $training->issues_arising }}</td>
                        </tr>
                        <tr>
                            <th>Positive Findings</th>
                            <td field-key='sponsor'>{{ $training->positive_findings }}</td>
                        </tr>
                        <tr>
                            <th>Improvement Areas</th>
                            <td field-key='comments'>{!! $training->improvement_areas!!}</td>
                        </tr>
                        <tr>
                            <th>Recommendations</th>
                            <td field-key='comments'>{!! $training->recommendations!!}</td>
                        </tr>                        
                    </table>                   
                        <a data-toggle="modal" data-target="#update_mentorship" class="btn btn-info fa fa-pencil">Update</a>
               
                </div>
                <div class="col-md-8">

                    <div class="box box-info">
                        <div class="box-header">
                            <div class="row">
                                <div class="col-md-6">
                                    Participants for {{$training->title or ''."(".$training->start_date." to ".$training->end_date.")"}}
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
                                    <th>@lang('quickadmin.participant.fields.first-name')</th>
                                    <th>@lang('quickadmin.participant.fields.middle-name')</th>
                                    <th>@lang('quickadmin.participant.fields.last-name')</th>
                                    <th>@lang('quickadmin.participant.fields.mobile')</th>
                                    <th>@lang('quickadmin.participant.fields.sex')</th>
                                    <th>@lang('quickadmin.participant.fields.dob')</th>
                                    <th>@lang('quickadmin.participant.fields.health-facility')</th>                                    
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if (count($participants) > 0)
                                    @foreach ($participants as $participant)
                                        <tr data-entry-id="{{ $participant->id }}">                                         
                                            <td field-key='first_name'>{{ $participant->first_name }}</td>
                                            <td field-key='middle_name'>{{ $participant->middle_name }}</td>
                                            <td field-key='last_name'>{{ $participant->last_name }}</td>
                                            <td field-key='mobile'>{{ $participant->mobile }}</td>
                                            <td field-key='sex'>{{ $participant->sex }}</td>
                                            <td field-key='dob'>{{ $participant->dob }}</td>
                                            <td field-key='health_facility'>{{ $participant->pivot->facility }}</td>
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

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="box box-success">
                        <div class="box box-header">

                           Adding Mentors

                        </div>
                        <div class="box-body">

                            <form action="{{route('admin.mentorship.attachMentors')}}" method="post">
                                {{ csrf_field() }}

                                <input type="hidden" name="id" value="{{$training->id}}">

                                <label>Please select mentors</label>

                                <select name="mentors[]" class="form-control select2" multiple required="">
                                    @foreach($mentors as $mentor)

                                        <option value="{{$mentor->id}}">{{$mentor->name}}</option>

                                    @endforeach
                                </select>

                                <input type="submit" class="btn btn-success" value="Add Participants">


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

                            <form action="{{route('admin.mentorship.addParticipant')}}" method="post">
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

            <div class="row">
                <div class="col-md-6">

                    <div class="box box-info">
                        <div class="box-header">
                            <div class="row">
                                <div class="col-md-6">
                                    Mentors for {{$training->title or ''."(".$training->start_date." to ".$training->end_date.")"}}
                                </div>
                               

                            </div>


                        </div>
                        <div class="box-body table-responsive">
                            <table class="table table-bordered table-striped datatable">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Action</th>                                  

                                </tr>
                                </thead>
                                <tbody>
                                @if (count($training_mentors) > 0)
                                    @foreach ($training_mentors as $mentor)
                                        <tr data-entry-id="{{ $mentor->id }}">
                                            <td field-key='first_name'>{{ $mentor->name}}</td>
                                            <td field-key='first_name'>{{ $mentor->email  }}</td>
                                            
                                            <td>
                                                @can('participant_view')
                                                    <a href="" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                                @endcan
                                                @can('participant_edit')

                                                    <a                               
                                                       class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                                @endcan
                                                @can('participant_delete')
                                                    {!! Form::open(array(
                                                                                            'style' => 'display: inline-block;',
                                                                                            'method' => 'DELETE',
                                                                                            'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                                                                            'route' => ['admin.participants.destroy', $mentor->id])) !!}
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

                        




                    </div>
                </div>

            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.mentorship.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
 

    <!--=========================== Modal to Add new  Participants to the selected Mentorship ==============================================-->


    <div id="NewPartsModal" class="modal fade" role="document">
        <div class="modal-dialog modal-lg ">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header modal-danger">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">New Participant </h4>
                </div>
                <div class="modal-body">
                    <div id="message" class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>

                    <div class="box-default">
                        <div class="box-success">

                           Mentor

                        </div>
                        <div class="box-body">

                            <form id="participant_form" method="post">
                                {{ csrf_field() }}
                                <div class="row">

                                    <input type="hidden" name="mentorship_id" id="mentorship_id" value="{{$training->id}}">

                                    <div class="col-xs-4 form-group" id="first_name-form">
                                        {!! Form::label('first_name', trans('quickadmin.participant.fields.first-name').'*', ['class' => 'control-label']) !!}
                                        {!! Form::text('first_name', old('first_name'), ['class' => 'form-control','id'=>'first_name', 'placeholder' => '', 'required' => '']) !!}
                                        <span class="help-block">
                                            <strong id="error-first_name"></strong>
                                    </span>
                                    </div>
                                    <div class="col-xs-4 form-group" id="middle_name-form">
                                        {!! Form::label('middle_name', trans('quickadmin.participant.fields.middle-name').'', ['class' => 'control-label']) !!}
                                        {!! Form::text('middle_name', old('middle_name'), ['class' => 'form-control','id'=>'middle_name', 'placeholder' => '']) !!}
                                        <span class="help-block">
                                            <strong id="error-middle_name"></strong>
                                    </span>
                                    </div>
                                    <div class="col-xs-4 form-group" id="last_name-form">
                                        {!! Form::label('last_name', trans('quickadmin.participant.fields.last-name').'', ['class' => 'control-label']) !!}
                                        {!! Form::text('last_name', old('last_name'), ['class' => 'form-control','id'=>'last_name', 'placeholder' => '']) !!}
                                        <span class="help-block">
                                            <strong id="error-last_name"></strong>
                                    </span>
                                    </div>
                                </div>

                                <div class="row">
                                    
                                    <div class="col-xs-4 form-group" id="mobile-form">
                                        {!! Form::label('mobile', trans('quickadmin.participant.fields.mobile').'', ['class' => 'control-label']) !!}
                                        {!! Form::text('mobile', old('mobile'), ['class' => 'form-control','id'=>'mobile', 'placeholder' => '']) !!}
                                        <span class="help-block">
                                            <strong id="error-mobile"></strong>
                                    </span>
                                    </div>
                                    <div class="col-xs-4 form-group " id="sex-form">
                                        {!! Form::label('sex', trans('quickadmin.participant.fields.sex').'*', ['class' => 'control-label']) !!}
                                        {!! Form::select('sex', $enum_sex, old('sex'), ['class' => 'form-control select2','id'=>'sex', 'required' => '']) !!}
                                        <span class="help-block">
                                            <strong id="error-sex"></strong>
                                    </span>
                                    </div>

                                    <div class="col-xs-4 form-group" id="dob-form">
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
                                        {!! Form::select('health_facility', $venues, old('health_facility'), ['class' => 'form-control select2','id'=>'health_facility']) !!}
                                      
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
                                        {!! Form::label('job_title_id', trans('quickadmin.participant.fields.job-title').'', ['class' => 'control-label']) !!}<br>
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

                                           <input type="text"  class="form-control"  placeholder="{{$training->name}}" readonly>

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

                                        <input type="text"  class="form-control"  placeholder="{{$training->name}}" readonly>

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

    
    <!-- Modal updating mentorship -->
<div class="modal fade" id="update_mentorship" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Mentorship</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>        
      
        <div class="modal-body">

            {!! Form::model($training, ['method' => 'PUT', 'route' => ['admin.mentorship.update',  $training->id],]) !!}
          <div class="box box-info">
         
          
              <div class="box box-body">
             
                  <div class="row">
                    <div class="col-xs-6 form-group">
  
                        {!! Form::label('title', 'Training Name', ['class' => 'control-label']) !!}
                        {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                        <p class="help-block"></p>
                        @if($errors->has('title'))
                            <p class="help-block">
                                {{ $errors->first('title') }}
                            </p>
                        @endif

                    </div>
                    <div class="col-xs-6">
                        {!! Form::label('category', 'Training Category', ['class' => 'control-label']) !!}<br>
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
                      
                    <div class="col-xs-4">
                        {!! Form::label('srart_date', 'Start Date', ['class' => 'control-label']) !!}
                        {!! Form::text('srart_date', old('srart_date'), ['class' => 'form-control date', 'placeholder' => '', 'required' => '']) !!}
                        <p class="help-block"></p>
                        @if($errors->has('srart_date'))
                            <p class="help-block">
                                {{ $errors->first('srart_date') }}
                            </p>
                        @endif

                    </div>
                    <div class="col-xs-4">
                        {!! Form::label('end_date', 'End Date', ['class' => 'control-label']) !!}
                        {!! Form::text('end_date', old('end_date'), ['class' => 'form-control date', 'placeholder' => '', 'required' => '']) !!}
                        <p class="help-block"></p>
                        @if($errors->has('end_date'))
                            <p class="help-block">
                                {{ $errors->first('end_date') }}
                            </p>
                        @endif
                    </div>
                    <div class="col-xs-4">
                        {!! Form::label('facility_name', 'Venue', ['class' => 'control-label']) !!}<br>
                        {!! Form::select('facility_name', $venues, old('facility_name'), ['class' => 'form-control select2', 'required' => '']) !!}
                       
                        <p class="help-block"></p>
                        @if($errors->has('facility_name'))
                            <p class="help-block">
                                {{ $errors->first('facility_name') }}
                            </p>
                        @endif
                    </div>
                  </div>
                  <div class="row">                    
                        <div class="col-xs-6">
                            {!! Form::label('issues_arising', 'Issues Arising', ['class' => 'control-label']) !!}
                            {!! Form::textarea('issues_arising', old('issues_arising'), ['class' => 'form-control','rows' => 5, 'cols' => 10,'id'=>'issues_arising', 'placeholder' => '']) !!}
                            <p class="help-block"></p>
                            @if($errors->has('issues_arising'))
                                <p class="help-block">
                                    {{ $errors->first('issues_arising') }}
                                </p>
                            @endif
                        </div>
                    
                        <div class="col-xs-6">
                            {!! Form::label('positive_findings', 'Positive Feedback', ['class' => 'control-label']) !!}
                            {!! Form::textarea('positive_findings', old('positive_findings'), ['class' => 'form-control','rows' => 5, 'cols' => 10,'id'=>'positive_findings', 'placeholder' => '']) !!}
                            <p class="help-block"></p>
                            @if($errors->has('positive_findings'))
                                <p class="help-block">
                                    {{ $errors->first('positive_findings') }}
                                </p>
                            @endif
                        </div>
                  </div> 
                  <div class="row">
                    <div class="col-xs-6">
                        {!! Form::label('improvement_areas', 'Improvement Areas', ['class' => 'control-label editor']) !!}
                        {!! Form::textarea('improvement_areas', old('improvement_areas'), ['class' => 'form-control','rows' => 5, 'cols' => 10,'id'=>'improvement_areas', 'placeholder' => '']) !!}
                        <p class="help-block"></p>
                        @if($errors->has('improvement_areas'))
                            <p class="help-block">
                                {{ $errors->first('improvement_areas') }}
                            </p>
                        @endif
                    </div>
                    <div class="col-xs-6">
                        {!! Form::label('recommendations', 'Recommendations', ['class' => 'control-label']) !!}
                        {!! Form::textarea('recommendations', old('recommendations'), ['class' => 'form-control editor','rows' => 5, 'cols' => 10,'id'=>'recommendations', 'placeholder' => '']) !!}
                        <p class="help-block"></p>
                        @if($errors->has('recommendations'))
                            <p class="help-block">
                                {{ $errors->first('recommendations') }}
                            </p>
                        @endif
                    </div>
                  </div>               
                  
       
                 
                
              </div>
              

          </div>

          {!! Form::submit('Update Mentorship', ['class' => ' btn btn-success']) !!}
          {!! Form::close() !!}

        </div>
        <div class="modal-footer">

            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
           
       
        
        </div>
      </div>
    </div>
  </div>
@stop

@section('javascript')
    @parent
    <script src="//cdn.ckeditor.com/4.5.4/full/ckeditor.js"></script>
    <script>
        $('.editor').each(function () {
            
                  CKEDITOR.replace($(this).attr('id'));
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
            var url = "{{route('admin.mentorship.saveParticipant')}}";
            var data = $("#participant_form").serialize();

         
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
         

            //Ajax adding data to the database
            $.ajax({
                type: "POST",
                url: url,
                data: data,
                dataType: "JSON",
                success: function (data) {
                    if(data.errors)
                    {                       
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
        var save_method;


        $(document).on('click', '#p_attach', function() {

            // $('#a_training').val(data.id);
            $('#a_part').val($(this).data('fname')+' '+$(this).data('lname' ));
            $('#a_hidden').val($(this).data('id'));
            $('#p_pin').val($(this).data('pin'));
            $('#participant_id').val($(this).data('partid'));



        });



    
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
