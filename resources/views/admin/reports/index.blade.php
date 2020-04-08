@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">Training Report</h3>
    @can('user_create')
    <p>
        <a href="{{ route('admin.reports.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
        
    </p>
    @endcan

    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($reports) > 0 ? 'datatable' : '' }} @can('report_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('user_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>Training Title</th>
                        <th>Training Type</th>
                        <th>Objectives</th>
                        <th>venue</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Expectd Outcomes</th>
                        <th>Challenges</th>
                        <th>Recomendations</th>
                                                <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($reports) > 0)
                        @foreach ($reports as $report)
                            <tr data-entry-id="{{ $report->id }}">
                                @can('user_delete')
                                    <td></td>
                                @endcan

                                <td field-key='name'>{{ $report->training_name }}</td>
                                <td field-key='email'>{{ $report->training_type }}</td>
                                <td field-key='role'>{{ $report->training_objectives }}</td>

                                <td field-key='name'>{{ $report->training_venue }}</td>
                                <td field-key='email'>{{ $report->start_date }}</td>
                                <td field-key='role'>{{ $report->end_date }}</td>
                                <td field-key='role'>{{ $report->expected_outcome }}</td>
                                <td field-key='role'>{{ $report->challenges }}</td>
                                <td field-key='role'>{{ $report->recommendation }}</td>
                                
                                                                <td>
                                    @can('user_view')
                                    <a href="{{ route('admin.reports.show',[$report->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('user_edit')
                                    <a href="{{ route('admin.reports.edit',[$report->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('user_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.reports.destroy', $report->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="10">@lang('quickadmin.qa_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('user_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.reports.mass_destroy') }}';
        @endcan

    </script>
@endsection