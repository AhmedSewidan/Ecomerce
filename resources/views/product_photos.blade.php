{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('product_id', 'Product_id:') !!}
			{!! Form::text('product_id') !!}
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