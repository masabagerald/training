@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">Regions</h3>
    @can('training_create')
    <p>
        <a href="{{ route('admin.regions.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
        
    </p>
    @endcan

    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($regions) > 0 ? 'datatable' : '' }} @can('region_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('training_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>Name</th>
                                                <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($regions) > 0)
                        @foreach ($regions as $region)
                            <tr data-entry-id="{{ $region->id }}">
                                @can('training_delete')
                                    <td></td>
                                @endcan

                                <td field-key='title'>{{ $region->name }}</td>
                                                                <td>
                                    @can('training_view')
                                    <a href="{{ route('admin.regions.show',[$region->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('training_edit')
                                    <a href="{{ route('admin.regions.edit',[$region->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('training_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.regions.destroy', $region->id])) !!}
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
        @can('region_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.regions.mass_destroy') }}';
        @endcan

    </script>
@endsection