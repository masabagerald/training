<tr data-index="{{ $index }}">
    <td>{!! Form::text('previous['.$index.'][training]', old('previous['.$index.'][training]', isset($field) ? $field->training: ''), ['class' => 'form-control','id'=>'previous['.$index.'][training]']) !!}</td>
    <td>{!! Form::date('previous['.$index.'][date]', old('previous['.$index.'][date', isset($field) ? $field->date: ''), ['class' => 'form-control','id'=>'previous['.$index.'][date]']) !!}</td>
    <td>{!! Form::text('previous['.$index.'][organization]', old('previous['.$index.'][organization]', isset($field) ? $field->organization: ''), ['class' => 'form-control','id'=>'previous['.$index.'][organization]']) !!}</td>


    <td>
        <a href="#" class="remove btn btn-xs btn-danger">@lang('quickadmin.qa_delete')</a>
    </td>
</tr>