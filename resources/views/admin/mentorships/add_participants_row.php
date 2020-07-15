<tr data-index="{{ $index }}">
    <td>{!! Form::text('previous['.$index.'][name]', old('previous['.$index.'][name]', isset($field) ? $field->name: ''), ['class' => 'form-control']) !!}</td>
    <td>{!! Form::text('previous['.$index.'][gender]', old('previous['.$index.'][gender]', isset($field) ? $field->gender: ''), ['class' => 'form-control']) !!}</td>
    <td>{!! Form::text('previous['.$index.'][cadre]', old('previous['.$index.'][cadre', isset($field) ? $field->cadre: ''), ['class' => 'form-control']) !!}</td>    
    <td>{!! Form::text('previous['.$index.'][phone]', old('previous['.$index.'][phone]', isset($field) ? $field->phone: ''), ['class' => 'form-control']) !!}</td>
    <td>{!! Form::text('previous['.$index.'][email]', old('previous['.$index.'][email]', isset($field) ? $field->email: ''), ['class' => 'form-control']) !!}</td>
   

    <td>
        <a href="#" class="remove btn btn-xs btn-danger">@lang('quickadmin.qa_delete')</a>
    </td>
</tr>