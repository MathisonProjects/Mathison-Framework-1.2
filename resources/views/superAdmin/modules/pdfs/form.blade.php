<h2>PDFs</h2>
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

		<div class='form-group'>
			{!! Form::label('rid', 'Report') !!}
			{!! Form::select('rid', $reports, null, array('id' => 'rid', 'class' => 'form-control')) !!}
		</div>
	</div>
	<div class='col-md-12'>
		<div class='form-group'>
			{!! Form::label('pdfheader', 'PDF Header') !!}
			{!! Form::textarea('pdfheader', null, array('id' => 'pdfheader', 'placeholder' => 'PDF Body', 'class' => 'form-control')) !!}
		</div>
		<div class='form-group'>
			{!! Form::label('pdffooter', 'PDF Footer') !!}
			{!! Form::textarea('pdffooter', null, array('id' => 'pdffooter', 'placeholder' => 'PDF Body', 'class' => 'form-control')) !!}
		</div>
		{!! Form::submit('Submit', ['class' => 'btn btn-primary col-md-12']) !!}
	</div>
</div>