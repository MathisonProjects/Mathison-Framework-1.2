<div class='row'>
	<div class='col-md-4'>
		<div class='form-group'>
			{!! Form::label('randomid', 'Random Id') !!}
			{!! Form::text('randomid', null, ['class' => 'form-control']) !!}
		</div>
		<div class='form-group'>
			{!! Form::label('name', 'Name') !!}
			{!! Form::text('name', null, ['class' => 'form-control']) !!}
		</div>
		<div class='form-group'>
			{!! Form::label('targeturl', 'Target URL') !!}
			{!! Form::text('targeturl', null, ['class' => 'form-control']) !!}
		</div>
		<div class='form-group'>
			{!! Form::label('jsondefaults', 'JSON Defaults') !!}
			{!! Form::textarea('jsondefaults', null, ['class' => 'form-control']) !!}
		</div>
		<div class='form-group'>
			{!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
		</div>
	</div>
</div>