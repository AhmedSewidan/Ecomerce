{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('title', 'Title:') !!}
			{!! Form::text('title') !!}
		</li>
		<li>
			{!! Form::label('photo', 'Photo:') !!}
			{!! Form::textarea('photo') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}