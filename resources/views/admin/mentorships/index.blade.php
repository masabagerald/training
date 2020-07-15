@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <div class="row">

        <div class="col-md-6">
            <h3 class="page-title">Mentorship List</h3>
            @can('role_create')
                <p>
                    <a href="{{ route('admin.mentorship.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>

                </p>
            @endcan

        </div>

       
    </div>


    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($mentorships) > 0 ? 'datatable' : '' }} @can('role_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('role_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan
                       

                        <th>Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Facility</th>
                        <th>Issues Arising</th>
                        <th>Positive findings</th>
                        <th>Improvement Areas</th>
                        <th>Reccomendations</th>
                        <th>Notes</th>

                        <th>Action</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($mentorships) > 0)
                        @foreach ($mentorships as $mentorship)
                            <tr data-entry-id="{{ $mentorship->id }}">
                                @can('role_delete')
                                    <td></td>
                                @endcan

                                    <td field-key='title'>{{ $mentorship->title}}</td>
                                    <td field-key='title'>{{ $mentorship->srart_date}}</td>
                                    <td field-key='title'>{{ $mentorship->end_date}}</td>
                                    <td field-key='title'>{{ $mentorship->facility_name}}</td>
                                    <td>{{$mentorship->issues_arising}}</td>
                                    <td>{{$mentorship->positive_findings}}</td>
                                    <td>{{$mentorship->improvement_areas}}</td>
                                    <td>{{$mentorship->recommendations}}</td>
                                    <td>{{$mentorship->recommendations}}</td>
                                    
                                                                <td>
                                    @can('role_view')
                                    <a href="{{ route('admin.mentorships.show',[$mentorshipy->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('role_edit')
                                    <a href="{{ route('admin.mentorships.edit',[$mentorship->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('role_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.roles.destroy', $mentorship
                                        ->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6">@lang('quickadmin.qa_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('role_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.mentorship.mass_destroy') }}';
        @endcan

    </script>
@endsection