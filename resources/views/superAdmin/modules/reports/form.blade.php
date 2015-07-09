<div class='row'>
	<div class='col-md-4'>
		<div class='form-group'>
			{!! Form::label('name', 'PDF Name') !!}
			{!! Form::text('name', null, array('id' => 'name', 'placeholder' => 'name', 'class' => 'form-control', 'maxlength' => '25')) !!}
		</div>

		<div class='form-group'>
			{!! Form::label('description', 'Description') !!}
			{!! Form::text('description', null, array('id' => 'description', 'placeholder' => 'Description', 'class' => 'form-control', 'maxlength' => '255')) !!}
		</div>
		MUST BUILD OUT REPORT BUILDER
		{!! Form::submit('Submit', ['class' => 'btn btn-primary col-md-12']) !!}
	</div>
</div>