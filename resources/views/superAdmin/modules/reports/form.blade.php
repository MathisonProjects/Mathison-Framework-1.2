<div class='row'>
	<div class='col-md-4'>
		<div class='form-group'>
			{!! Form::label('name', 'Report Name') !!}
			{!! Form::text('name', null, array('id' => 'name', 'placeholder' => 'name', 'class' => 'form-control', 'maxlength' => '25')) !!}
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
			{!! Form::label('fields', 'Fields') !!}
			{!! Form::select('fields[]', array(), null, array('class' => 'form-control', 'multiple', 'id' => 'fields')) !!}
		</div>
		<div class='form-group'>
			{!! Form::label('filter', 'Filter Options') !!}
			<div id='filterArea'>

			</div>
		</div>
		<div class='form-group'>
			{!! Form::label('totals', 'Totals Options') !!}
			<div id='totalsArea'>

			</div>
		</div>
		
		{!! Form::submit('Submit', ['class' => 'btn btn-primary col-md-12']) !!}
	</div>
</div>

<?php


array(
	'object' => 'objectname',
	'fields' => array('fieldone','fieldtwo','fieldthree','fieldfour'),
	'filter' => array(
		array('fieldone'  , '==', 'value'),
		array('fieldtwo'  , '!=', 'value'),
		array('fieldthree', '>=', 'value'),
		array('fieldfour' , '<=', 'value')),
	'totals' => array(
		array('fieldone', 'sum'),
		array('fieldtwo', 'difference'),
		array('average' , 'average'))
	);
?>