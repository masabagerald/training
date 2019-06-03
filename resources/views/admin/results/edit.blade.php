@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.designation.title')</h3>
    
    {!! Form::model($designation, ['method' => 'PUT', 'route' => ['admin.designations.update', $designation->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', trans('quickadmin.designation.fields.name').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            Participant
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>@lang('quickadmin.participant.fields.first-name')</th>
                        <th>@lang('quickadmin.participant.fields.middle-name')</th>
                        <th>@lang('quickadmin.participant.fields.last-name')</th>
                        <th>@lang('quickadmin.participant.fields.mobile')</th>
                        <th>@lang('quickadmin.participant.fields.health-facility')</th>
                        <th>@lang('quickadmin.participant.fields.postal-address')</th>
                        <th>@lang('quickadmin.participant.fields.district')</th>
                        <th>@lang('quickadmin.participant.fields.subcounty')</th>
                        <th>@lang('quickadmin.participant.fields.parish')</th>
                        <th>@lang('quickadmin.participant.fields.profession')</th>
                        
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody id="participant">
                    @forelse(old('participants', []) as $index => $data)
                        @include('admin.designations.participants_row', [
                            'index' => $index
                        ])
                    @empty
                        @foreach($designation->participants as $item)
                            @include('admin.designations.participants_row', [
                                'index' => 'id-' . $item->id,
                                'field' => $item
                            ])
                        @endforeach
                    @endforelse
                </tbody>
            </table>
            <a href="#" class="btn btn-success pull-right add-new">@lang('quickadmin.qa_add_new')</a>
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent

    <script type="text/html" id="participant-template">
        @include('admin.designations.participants_row',
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
@stop