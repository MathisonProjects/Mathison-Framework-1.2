<div class='row'>
	<div class='col-md-4'>
		<div class='form-group'>
			{!! Form::label('client_id', 'Client ID') !!}
			{!! Form::text('client_id', null, ['class' => 'form-control', 'placeholder' => 'Client ID']) !!}
		</div>
		<div class='form-group'>
			{!! Form::label('client_secret', 'Client Secret') !!}
			{!! Form::text('client_secret', null, ['class' => 'form-control', 'placeholder' => 'Client Secret']) !!}
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