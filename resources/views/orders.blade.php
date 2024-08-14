{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('client_id', 'Client_id:') !!}
			{!! Form::text('client_id') !!}
		</li>
		<li>
			{!! Form::label('address_id', 'Address_id:') !!}
			{!! Form::text('address_id') !!}
		</li>
		<li>
			{!! Form::label('pay', 'Pay:') !!}
			{!! Form::text('pay') !!}
		</li>
		<li>
			{!! Form::label('status', 'Status:') !!}
			{!! Form::text('status') !!}
		</li>
		<li>
			{!! Form::label('total', 'Total:') !!}
			{!! Form::text('total') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}