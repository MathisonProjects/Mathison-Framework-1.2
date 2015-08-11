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
			{!! Form::label('object', 'Object') !!}
			{!! Form::select('object', $objects, null, array('class' => 'form-control')) !!}
		</div>
		<div class='form-group'>
			{!! Form::label('field', 'Field') !!}
			{!! Form::select('field', array(), null, array('id' => 'fields', 'class' => 'form-control')) !!}
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
		</div>
		<div class='form-group'>
			{!! Form::label('lastran', 'Start Date') !!}
			<div class="input-append date" id="dp3" data-date="<?php echo date('M/d/Y'); ?>" data-date-format="mm/dd/yyyy">
				<input class="datepicker form-control" type="text" value="<?php echo date('m/d/Y'); ?>">
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
	$('.datepicker').datepicker();
</script>