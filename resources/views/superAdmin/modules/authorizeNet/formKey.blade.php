<div class='row'>
	<div class='col-md-4'>
		<div class='form-group'>
			{!! Form::label('api_login_id', 'API Login ID') !!}
			{!! Form::text('api_login_id', null, ['class' => 'form-control', 'placeholder' => 'API Login ID']) !!}
		</div>
		<div class='form-group'>
			{!! Form::label('transaction_key', 'Transaction Key') !!}
			{!! Form::text('transaction_key', null, ['class' => 'form-control', 'placeholder' => 'Transaction Key']) !!}
		</div>
		<div class='form-group'>
			{!! Form::label('sandbox', 'Sandbox') !!}
			{!! Form::select('sandbox', array('' => '',
										  0 => 'No',
										  1 => 'Yes'), null, ['class' => 'form-control']) !!}
		</div>
		<div class='form-group'>
			{!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
		</div>
	</div>
</div>