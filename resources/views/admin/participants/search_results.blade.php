@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.participant.title')</h3>
    @can('participant_create')
        <p>
            <a href="{{ route('admin.participants.create') }}" class="btn btn-success">Back</a>

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


    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
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

@section('javascript')
    <script>
        @can('participant_delete')
                @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.participants.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection