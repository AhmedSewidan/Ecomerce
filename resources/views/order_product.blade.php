{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('product_id', 'Product_id:') !!}
			{!! Form::text('product_id') !!}
		</li>
		<li>
			{!! Form::label('order_id', 'Order_id:') !!}
			{!! Form::text('order_id') !!}
		</li>
		<li>
			{!! Form::label('price', 'Price:') !!}
			{!! Form::text('price') !!}
		</li>
		<li>
			{!! Form::label('quantity', 'Quantity:') !!}
			{!! Form::text('quantity') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}