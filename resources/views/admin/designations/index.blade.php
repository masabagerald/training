@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <h3 class="page-title">@lang('quickadmin.designation.title')</h3>
            @can('designation_create')
                <p>
                    <a href="{{ route('admin.designations.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>

                </p>
            @endcan

        </div>


        <div class="col-md-6 pull-right">
            <div class="box box-success">
                <div class="box box-header">

                    Upload Job Titles

                </div>
                <div class="box-body">

                    <form class="md-form" method="post" action="{{route('admin.designations.import')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="file-field ">
                            <input type="hidden" name="training_id" value="">
                            <div class="btn btn-rounded peach-gradient btn-lg float-left">
                                <span class="text-info">Choose excel file</span>
                                <input type="file" name="designations" class="form-control">
                            </div>


                            <input type="submit" value="Upload" class="btn btn-instagram">



                        </div>
                    </form>

                </div>

            </div>

        </div>

    </div>

    @can('designation_delete')
    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.designations.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('quickadmin.qa_all')</a></li> |
            <li><a href="{{ route('admin.designations.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('quickadmin.qa_trash')</a></li>
        </ul>
    </p>
    @endcan


    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($designations) > 0 ? 'datatable' : '' }} @can('designation_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('designation_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('quickadmin.designation.fields.name')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($designations) > 0)
                        @foreach ($designations as $designation)
                            <tr data-entry-id="{{ $designation->id }}">
                                @can('designation_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

                                <td field-key='name'>{{ $designation->name }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('designation_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.designations.restore', $designation->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('designation_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.designations.perma_del', $designation->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('designation_view')
                                    <a href="{{ route('admin.designations.show',[$designation->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('designation_edit')
                                    <a href="{{ route('admin.designations.edit',[$designation->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('designation_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.designations.destroy', $designation->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
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
        @can('designation_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.designations.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection