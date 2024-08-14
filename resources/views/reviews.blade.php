{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('client_id', 'Client_id:') !!}
			{!! Form::text('client_id') !!}
		</li>
		<li>
			{!! Form::label('product_id', 'Product_id:') !!}
			{!! Form::text('product_id') !!}
		</li>
		<li>
			{!! Form::label('body', 'Body:') !!}
			{!! Form::textarea('body') !!}
		</li>
		<li>
			{!! Form::label('stars', 'Stars:') !!}
			{!! Form::text('stars') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}