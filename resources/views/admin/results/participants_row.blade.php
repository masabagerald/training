<tr data-index="{{ $index }}">
    <td>{!! Form::text('participants['.$index.'][first_name]', old('participants['.$index.'][first_name]', isset($field) ? $field->first_name: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::text('participants['.$index.'][middle_name]', old('participants['.$index.'][middle_name]', isset($field) ? $field->middle_name: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::text('participants['.$index.'][last_name]', old('participants['.$index.'][last_name]', isset($field) ? $field->last_name: ''), ['class' => 'form-control']) !!}</td>zzz
<td>{!! Form::text('participants['.$index.'][mobile]', old('participants['.$index.'][mobile]', isset($field) ? $field->mobile: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::text('participants['.$index.'][health_facility]', old('participants['.$index.'][health_facility]', isset($field) ? $field->health_facility: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::text('participants['.$index.'][postal_address]', old('participants['.$index.'][postal_address]', isset($field) ? $field->postal_address: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::text('participants['.$index.'][district]', old('participants['.$index.'][district]', isset($field) ? $field->district: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::text('participants['.$index.'][subcounty]', old('participants['.$index.'][subcounty]', isset($field) ? $field->subcounty: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::text('participants['.$index.'][parish]', old('participants['.$index.'][parish]', isset($field) ? $field->parish: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::text('participants['.$index.'][profession]', old('participants['.$index.'][profession]', isset($field) ? $field->profession: ''), ['class' => 'form-control']) !!}</td>

    <td>
        <a href="#" class="remove btn btn-xs btn-danger">@lang('quickadmin.qa_delete')</a>
    </td>
</tr>