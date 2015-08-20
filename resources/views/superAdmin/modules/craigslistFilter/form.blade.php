<div class='row'>
	<div class='col-md-4'>
		<div class='form-group'>
			{!! Form::label('phrase', 'Phrase') !!}
			{!! Form::text('phrase', null, ['class' => 'form-control']) !!}
		</div>
		<div class='form-group'>
			{!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
		</div>
	</div>
</div>