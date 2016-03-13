<div class='row'>
	<div class='col-md-12'>
		<div class='form-group'>
			{!! Form::label('name', 'Function Name') !!}
			{!! Form::text('name', null, ['class' => 'form-control']) !!}
		</div>

		@if (!isset($edit))
		<div class='form-group'>
			{!! Form::label('aid', 'API') !!}
			{!! Form::select('aid', $aid, null, ['class' => 'form-control']) !!}
		</div>
		@endif
		<div class='form-group'>
			{!! Form::label('nextFid', 'Next Function') !!}
			{!! Form::select('nextFid', $nextFid, null, ['class' => 'form-control']) !!}
		</div>
		@if (isset($edit))
			<div class='form-group'>
				<div class='row'>
					<div class='col-md-2'>
						<b>Field Name</b>
					</div>
					<div class='col-md-2'>
						<b>Modify?</b>
					</div>
					<div class='col-md-3'>
						<b>Modification Type</b>
					</div>
					<div class='col-md-3'>
						<b>Source</b>
					</div>
					<div class='col-md-2'>
						<b>Value</b>
					</div>
				</div>
			</div>
			@foreach ($fields as $key => $field)
				<div class='form-group'>
					<div class='row'>
						<div class='col-md-2'>
							{{ ucfirst($field) }}
						</div>
						<div class='col-md-2'>
							{!! Form::checkbox('data[select]['.$key.']', null, null, ['class' => 'form-control']) !!}
						</div>
						<div class='col-md-3'>
							{!! Form::select('data[modification]['.$key.']', array('', 'add' => 'Add', 'subtract' => 'Subtract', 'multiply' => 'Multiply', 'divide' => 'Divide', 'set' => 'Set'), null, ['class' => 'form-control']) !!}
						</div>
						<div class='col-md-3'>
							{!! Form::select('data[response]['.$key.']', array('', 'response' => 'Response', 'set' => 'Set'), null, ['class' => 'form-control']) !!}
						</div>
						<div class='col-md-2'>
							{!! Form::text('data[value]['.$key.']', null, ['class' => 'form-control']) !!}
						</div>
					</div>
				</div>
			@endforeach
		@endif
		<div class='form-group'>
			{!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
		</div>
	</div>
</div>