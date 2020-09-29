@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">Program Sponsors</h3>
    @can('training_create')
    <p>
        <a href="{{ route('admin.program_sponsors.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
        
    </p>
    @endcan    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($projects) > 0 ? 'datatable' : '' }} @can('role_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('role_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>Name</th>
                            <th>Donor</th>
                                                <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($projects) > 0)
                        @foreach ($projects as $project)
                            <tr data-entry-id="{{ $project->id }}">
                                @can('role_delete')
                                    <td></td>
                                @endcan

                                <td field-key='title'>{{ $project->name }}</td>
                                <td field-key='title'>{{ $project->donor }}</td>
                                                                <td>
                                    @can('role_view')
                                    <a href="{{ route('admin.program_sponsors.show',[$project->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('role_edit')
                                    <a href="{{ route('admin.program_sponsors.edit',[$project->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                   
                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td>@lang('quickadmin.qa_no_entries_in_table')</td>
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
            window.route_mass_crud_entries_destroy = '';
        @endcan

    </script>
@endsection