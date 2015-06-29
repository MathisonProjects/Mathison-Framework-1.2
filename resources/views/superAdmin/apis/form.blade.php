
<h2>API</h2>
{!! Form::open(['url'=>'admin/super/apis/']) !!}

	{!! Form::hidden('randomid', $randString) !!}
<div class='row'>
	<div class='col-md-4'>
		<div class='form-group'>
			{!! Form::label('name', 'API Name') !!}
			{!! Form::text('name', null, ['class' => 'form-control']) !!}
		</div>
		<div class='form-group'>
			{!! Form::label('action', 'Action') !!}
			{!! Form::select('action', array('' => 'Please Select Action', 'create' => 'Create', 'update' => 'Update', 'return_one' => 'Return Record', 'return_all' => 'Return Records', 'delete_one' => 'Delete Record', 'delete_all' => 'Delete Records'), '', ['class' => 'form-control']) !!}
		</div>
		<div class='form-group'>
			<?php
				$objects = array('0' => 'Please Select Object');
				foreach ($menu['objects'] as $item) {
					$objects[$item['id']] = $item['name'];
				}
			?>
			{!! Form::label('oid', 'Object') !!}
			{!! Form::select('oid', $objects, '', ['class' => 'form-control']) !!}
		</div>
		<div class='form-group'>
			<?php
				$forms = array('0' => 'Please Select Form');
				foreach ($menu['forms'] as $item) {
					$forms[$item['id']] = $item['name'];
				}
			?>
			{!! Form::label('fid', 'Form') !!}
			{!! Form::select('fid', $forms, '0', ['class' => 'form-control']) !!}
		</div>
		<div class='form-group'>
			{!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
		</div>
	</div>
</div>
{!! Form::close() !!}