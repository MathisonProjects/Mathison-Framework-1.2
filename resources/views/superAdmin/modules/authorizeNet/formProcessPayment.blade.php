<div class='row'>
	<div class='col-md-4'>
		<div class='form-group'>
			{!! Form::label('paymentProfile', 'Payment Profile') !!}
			{!! Form::select('paymentProfile', $paymentProfiles, null, ['class' => 'form-control']) !!}
		</div>
		<div class='form-group'>
			{!! Form::label('amount', 'Amount') !!}
			{!! Form::text('amount', null, ['class' => 'form-control', 'placeholder' => '1.23']) !!}
		</div>
		<div class='form-group'>
			{!! Form::label('itemId', 'Item ID') !!}
			{!! Form::text('itemId', null, ['class' => 'form-control', 'placeholder' => '4']) !!}
		</div>
		<div class='form-group'>
			{!! Form::label('name', 'Name') !!}
			{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Line Item Name']) !!}
		</div>
		<div class='form-group'>
			{!! Form::label('description', 'Description') !!}
			{!! Form::text('description', null, ['class' => 'form-control', 'placeholder' => 'This is a description']) !!}
		</div>
		<div class='form-group'>
			{!! Form::label('quantity', 'Quantity') !!}
			{!! Form::text('quantity', null, ['class' => 'form-control', 'placeholder' => '1']) !!}
		</div>
		<div class='form-group'>
			{!! Form::label('unitPrice', 'Unit Price') !!}
			{!! Form::text('unitPrice', null, ['class' => 'form-control', 'placeholder' => '1.23']) !!}
		</div>
		<div class='form-group'>
			{!! Form::label('taxable', 'Taxable') !!}
			{!! Form::select('taxable', array('', 'False' => 'False', 'True' => 'True'), null, ['class' => 'form-control', 'placeholder' => '1.23']) !!}
		</div>
		
		<div class='form-group'>
			{!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
		</div>
	</div>
</div>