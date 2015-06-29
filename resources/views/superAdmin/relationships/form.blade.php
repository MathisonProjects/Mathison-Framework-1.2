<h2>Relationships</h2>
<div class='row'>
	<div class='col-md-4'>
		<div class='form-group'>
			{!! Form::label('name', 'Relationship Name') !!}
			{!! Form::text('name', null, array('id' => 'name', 'placeholder' => 'name', 'class' => 'form-control', 'maxlength' => '25')) !!}
		</div>
		<div class='form-group'>
			{!! Form::label('relationshiptype', 'Relationship Type') !!}
			{!! Form::select('relationshiptype', array(0 => '', 1 => 'One to One', 2 => 'One to Many', 3 => 'Many to Many'), 0, array('id' => 'relationshiptype', 'class' => 'form-control')) !!}
		</div>
		<div class='form-group'>
			{!! Form::label('tableone', 'Table One') !!}
			{!! Form::select('tableone', array(), '', array('id' => 'tableone', 'placeholder' => 'Table One', 'class' => 'form-control', 'maxlength' => '25')) !!}
		</div>
		<div class='form-group'>
			{!! Form::label('fieldone', 'Field One') !!}
			{!! Form::select('fieldone', array(), '', array('id' => 'fieldone', 'placeholder' => 'Field One', 'class' => 'form-control', 'maxlength' => '25')) !!}
		</div>
		<div class='form-group'>
			{!! Form::label('tabletwo', 'Table Two') !!}
			{!! Form::select('tabletwo', array(), '', array('id' => 'tabletwo', 'placeholder' => 'Table Two', 'class' => 'form-control', 'maxlength' => '25')) !!}
		</div>
		<div class='form-group'>
			{!! Form::label('fieldtwo', 'Field Two') !!}
			{!! Form::select('fieldtwo', array(), '', array('id' => 'fieldtwo', 'placeholder' => 'Field Two', 'class' => 'form-control', 'maxlength' => '25')) !!}
		</div>
		{!! Form::submit('Submit', ['class' => 'btn btn-primary col-md-12']) !!}
	</div>
</div>