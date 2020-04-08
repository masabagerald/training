{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('name', 'Name:') !!}
			{!! Form::text('name') !!}
		</li>
		<li>
			{!! Form::label('job_title', 'Job_title:') !!}
			{!! Form::text('job_title') !!}
		</li>
		<li>
			{!! Form::label('cadre', 'Cadre:') !!}
			{!! Form::text('cadre') !!}
		</li>
		<li>
			{!! Form::label('duration_in_service', 'Duration_in_service:') !!}
			{!! Form::text('duration_in_service') !!}
		</li>
		<li>
			{!! Form::label('status_of_participant', 'Status_of_participant:') !!}
			{!! Form::text('status_of_participant') !!}
		</li>
		<li>
			{!! Form::label('district', 'District:') !!}
			{!! Form::text('district') !!}
		</li>
		<li>
			{!! Form::label('organization', 'Organization:') !!}
			{!! Form::text('organization') !!}
		</li>
		<li>
			{!! Form::label('facility_level', 'Facility_level:') !!}
			{!! Form::text('facility_level') !!}
		</li>
		<li>
			{!! Form::label('organization_ownership', 'Organization_ownership:') !!}
			{!! Form::text('organization_ownership') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}