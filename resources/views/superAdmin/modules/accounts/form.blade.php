<div class='row'>
	<div class='col-md-4'>
		<div class='form-group'>
			{!! Form::label('sessionid', 'Last Session Id') !!}
			{!! Form::text('sessionid', null, ['class' => 'form-control']) !!}
		</div>
		<div class='form-group'>
			{!! Form::label('accountlevel', 'Account Level') !!}
			{!! Form::select('accountlevel', array(3 => 'Guest',
										  		   2 => 'User',
										  		   1 => 'Admin',
										  		   0 => 'Super Admin'), '', ['class' => 'form-control']) !!}
		</div>
		<div class='form-group'>
			{!! Form::label('email', 'Email') !!}
			{!! Form::text('email', null, ['class' => 'form-control']) !!}
		</div>
		<div class='form-group'>
			{!! Form::label('username', 'Username') !!}
			{!! Form::text('username', null, ['class' => 'form-control']) !!}
		</div>
		<div class='form-group'>
			{!! Form::label('password', 'Password') !!}
			{!! Form::text('password', null, ['class' => 'form-control']) !!}
		</div>
		<div class='form-group'>
			{!! Form::label('hash', 'Hash') !!}
			{!! Form::text('hash', null, ['class' => 'form-control']) !!}
		</div>
		<div class='form-group'>
			{!! Form::label('active', 'Active') !!}

			{!! Form::select('active', array(0 => '',
										  0 => 'No',
										  1 => 'Yes'), '', ['class' => 'form-control']) !!}
		</div>

		<div class='form-group'>
			{!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
		</div>
	</div>
</div>