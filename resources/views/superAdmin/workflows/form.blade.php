<div class='row'>
	<div class='col-md-4'>
		<div class='form-group'>
			{!! Form::label('name', 'Workflow Name') !!}
			{!! Form::text('name', null, array('id' => 'name', 'placeholder' => 'name', 'class' => 'form-control', 'maxlength' => '25')) !!}
		</div>

		<div class='form-group'>
			{!! Form::label('referrerOrigin', 'Referrer URL') !!}
			{!! Form::text('referrerOrigin', null, array('id' => 'referrerOrigin', 'placeholder' => 'Referrer URL', 'class' => 'form-control', 'maxlength' => '255')) !!}
		</div>
		<div class='form-group'>
			{!! Form::label('originaldestination', 'Original Destination') !!}
			{!! Form::text('originaldestination', null, array('id' => 'originaldestination', 'placeholder' => 'Original URL', 'class' => 'form-control', 'maxlength' => '255')) !!}
		</div>
		<div class='form-group'>
			{!! Form::label('finaldestination', 'Final Destination') !!}
			{!! Form::text('finaldestination', null, array('id' => 'finaldestination', 'placeholder' => 'Final Destination', 'class' => 'form-control', 'maxlength' => '255')) !!}
		</div>
		<div class='form-group'>
			<label for='default'>Default:</label><br />
			{!! Form::radio('default', '1'); !!} True<br />
			{!! Form::radio('default', '0'); !!} False<br />
		</div>
		{!! Form::submit('Submit', ['class' => 'btn btn-primary col-md-12']) !!}
	</div>
</div>