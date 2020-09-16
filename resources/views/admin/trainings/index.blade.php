@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.training.title')</h3>
    @can('training_create')
    <p>
        <a href="{{ route('admin.trainings.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
        
    </p>
    @endcan

    @can('training_delete')
    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.trainings.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('quickadmin.qa_all')</a></li> |
            <li><a href="{{ route('admin.trainings.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('quickadmin.qa_trash')</a></li>
        </ul>
    </p>
    @endcan


    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($trainings) > 0 ? 'datatable' : '' }} @can('training_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('training_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>Training Title</th>
                        <th>@lang('quickadmin.training.fields.type-of-training')</th>
                        <th>@lang('quickadmin.training.fields.region')</th>
                        <th>@lang('quickadmin.training.fields.venue')</th>
                        <th>@lang('quickadmin.training.fields.start-date')</th>
                        <th>@lang('quickadmin.training.fields.end-date')</th>

                        <th>@lang('quickadmin.training.fields.sponsor')</th>
                        <th>@lang('quickadmin.training.fields.comments')</th>
                        {{--<th>@lang('quickadmin.training.fields.pictures')</th>--}}
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($trainings) > 0)
                        @foreach ($trainings as $training)
                            <tr data-entry-id="{{ $training->id }}">
                                @can('training_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

                                <td><a href="{{route('admin.trainings.show',[$training->id])}}">{{ $training->title}}</a></td>		

                                <td field-key='type_of_training'><a href="{{route('admin.trainings.show',[$training->id])}}">{{ $training->type->name or '' }}</a></td><td field-key='region'>{{ $training->region }}</td>
                                <td field-key='venue'>{{ $training->venue }}</td>
                                <td field-key='start_date'>{{ $training->start_date }}</td>
                                <td field-key='end_date'>{{ $training->end_date }}</td>

                                <td field-key='sponsor'>{{ $training->sponsor }}</td>
                                <td field-key='comments'>{!! $training->comments !!}</td>
                                {{--<td field-key='pictures'> @foreach($training->getMedia('pictures') as $media)--}}
                                {{--<p class="form-group">--}}
                                    {{--<a href="{{ $media->getUrl() }}" target="_blank">{{ $media->name }} ({{ $media->size }} KB)</a>--}}
                                {{--</p>--}}
                            {{--@endforeach</td>--}}
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('training_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.trainings.restore', $training->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('training_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.trainings.perma_del', $training->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('training_view')
                                    <a href="{{ route('admin.trainings.show',[$training->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('training_edit')
                                    <a href="{{ route('admin.trainings.edit',[$training->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('training_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.trainings.destroy', $training->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="14">@lang('quickadmin.qa_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('training_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.trainings.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection