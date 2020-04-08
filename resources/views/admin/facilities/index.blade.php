@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <div class="row">

        <div class="col-md-6">
            <h3 class="page-title">Health Facilities</h3>
            @can('role_create')
                <p>
                    <a href="{{ route('admin.facilities.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>

                </p>
            @endcan

        </div>

        <div class="col-md-6 pull-right">
            <div class="box box-success">
                <div class="box box-header">
                    Upload Health Facilities

                </div>
                <div class="box-body">

                    <form class="md-form" method="post" action="{{route('admin.facilities.import')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="file-field ">
                            <input type="hidden" name="training_id" value="">
                            <div class="btn btn-rounded peach-gradient btn-lg float-left">
                                <span class="text-info">Choose excel file</span>
                                <input type="file" name="facilities" class="form-control">
                            </div>


                            <input type="submit" value="Upload" class="btn btn-instagram">



                        </div>
                    </form>

                </div>

            </div>

        </div>

    </div>


    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($facilities) > 0 ? 'datatable' : '' }} @can('role_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('role_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>Name</th>
                        <th>In charge</th>
                        <th>Telephone no</th>
                        <th>Subcounty</th>

                        <th>Action</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($facilities) > 0)
                        @foreach ($facilities as $facility)
                            <tr data-entry-id="{{ $facility->id }}">
                                @can('role_delete')
                                    <td></td>
                                @endcan

                                    <td field-key='title'>{{ $facility->name}}</td>
                                    <td field-key='title'>{{ $facility->incharge}}</td>
                                    <td field-key='title'>{{ $facility->telephone}}</td>
                                    <td field-key='title'>{{ $facility->incharge}}</td>
                                                                <td>
                                    @can('role_view')
                                    <a href="{{ route('admin.facilities.show',[$facility->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('role_edit')
                                    <a href="{{ route('admin.facilities.edit',[$facility->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('role_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.roles.destroy', $facility
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
            window.route_mass_crud_entries_destroy = '{{ route('admin.roles.mass_destroy') }}';
        @endcan

    </script>
@endsection