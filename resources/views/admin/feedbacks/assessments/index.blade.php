@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">Participants Assessment</h3>
    @can('role_create')
    <p>
        <a href="{{ route('admin.assessments.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
        
    </p>
    @endcan

    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($assessments) > 0 ? 'datatable' : '' }} @can('role_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('role_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan


                            <th>Assessment Date</th>
                            <th>Interviwer name</th>
                            <th>Challenges </th>
                            <th>Recommendations</th>

                                                <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($assessments) > 0)
                        @foreach ($assessments as $assessment)
                            <tr data-entry-id="{{ $assessment->id }}">
                                @can('role_delete')
                                    <td></td>
                                @endcan

                                    <td field-key='title'>{{ $assessment->date }}</td>
                                    <td field-key='title'></td>
                                    <td field-key='title'>{{ $assessment->challenges }}</td>
                                    <td field-key='title'>{{ $assessment->Recommendations }}</td>
                                                                <td>
                                    @can('role_view')
                                    <a href="{{ route('admin.roles.show',[$assessment->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('role_edit')
                                    <a href="{{ route('admin.roles.edit',[$assessment->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('role_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.categories.destroy', $assessment->id])) !!}
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
            window.route_mass_crud_entries_destroy = '{{ route('admin.roles.mass_destroy') }}';
        @endcan

    </script>
@endsection