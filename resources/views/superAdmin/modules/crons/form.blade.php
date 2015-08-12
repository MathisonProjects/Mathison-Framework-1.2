<div class='row'>
	<div class='col-md-4'>
		<div class='form-group'>
			{!! Form::label('name', 'Cron Job Name') !!}
			{!! Form::text('name', null, array('id' => 'name', 'placeholder' => 'Name', 'class' => 'form-control', 'maxlength' => '25')) !!}
		</div>
		<div class='form-group'>
			{!! Form::label('description', 'Description') !!}
			{!! Form::text('description', null, array('id' => 'description', 'placeholder' => 'Description', 'class' => 'form-control', 'maxlength' => '255')) !!}
		</div>
		<div class='form-group'>
			{!! Form::label('oid', 'Object') !!}
			{!! Form::select('oid', $objects, null, array('id' => 'object', 'class' => 'form-control')) !!}
		</div>
		<div class='form-group'>
			{!! Form::label('fid', 'Field') !!}
			{!! Form::select('fid', array(), null, array('id' => 'fields', 'class' => 'form-control')) !!}
		</div>
		<div class='form-group'>
			{!! Form::label('modtype', 'Mod Type') !!}
			{!! Form::select('modtype', array(
				'' => '',
				'add' => 'Add',
				'subtract' => 'Subtract',
				'multiply' => 'Multiply',
				'new_record' => 'New Record',
				'delete_record' => 'Delete Record'), null, array('class' => 'form-control')) !!}
		</div>
		<div class='form-group'>
			{!! Form::label('modifier', 'Modifier') !!}
			{!! Form::text('modifier', null, array('id' => 'modifier', 'placeholder' => 'Modifier', 'class' => 'form-control', 'maxlength' => '25')) !!}
		</div>
		<div class='form-group'>
			{!! Form::label('frequency', 'Frequency') !!}
			{!! Form::text('frequency', null, array('class' => 'form-control', 'placeholder' => 'Logic to come...')) !!}
		</div>
		<div class='form-group'>
			{!! Form::label('lastran', 'Start Date') !!}
			<div class="input-append date" id="dp3" data-date="<?php echo date('Y-m-d H:i:s'); ?>" data-date-format="Y-m-d H:i:s">
			{!! Form::text('lastran', date('Y-m-d H:i:s'), array('class' => 'datepicker form-control')) !!}
			</div>
		</div>
		<div class='form-group'>
			{!! Form::label('active', 'Active') !!}<br />
			{!! Form::radio('active', '1'); !!} True<br />
			{!! Form::radio('active', '0'); !!} False<br />
		</div>
		{!! Form::submit('Submit', ['class' => 'btn btn-primary col-md-12']) !!}
	</div>
</div>
<script type="text/javascript">
	$('.datepicker').datepicker({
		format: 'yyyy-mm-dd'
	});
	
</script>