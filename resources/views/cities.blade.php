{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('governorate_id', 'Governorate_id:') !!}
			{!! Form::text('governorate_id') !!}
		</li>
		<li>
			{!! Form::label('title', 'Title:') !!}
			{!! Form::text('title') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}