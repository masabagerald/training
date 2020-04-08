{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('date', 'Date:') !!}
			{!! Form::text('date') !!}
		</li>
		<li>
			{!! Form::label('department', 'Department:') !!}
			{!! Form::text('department') !!}
		</li>
		<li>
			{!! Form::label('challenges', 'Challenges:') !!}
			{!! Form::text('challenges') !!}
		</li>
		<li>
			{!! Form::label('recommendation', 'Recommendation:') !!}
			{!! Form::text('recommendation') !!}
		</li>
		<li>
			{!! Form::label('interviewee_id', 'Interviewee_id:') !!}
			{!! Form::text('interviewee_id') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}