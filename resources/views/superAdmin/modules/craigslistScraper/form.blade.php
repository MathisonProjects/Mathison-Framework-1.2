<div class='row'>
	<div class='col-md-4'>
		<div class='form-group'>
			{!! Form::label('citycode', 'City Code') !!}
			{!! Form::text('citycode', null, ['class' => 'form-control']) !!}
		</div>
		<div class='form-group'>
			{!! Form::label('section', 'Section Code ie CPG = Computer Services') !!}
			{!! Form::text('section', null, ['class' => 'form-control']) !!}
		</div>
		<div class='form-group'>
			{!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
		</div>
	</div>
</div>