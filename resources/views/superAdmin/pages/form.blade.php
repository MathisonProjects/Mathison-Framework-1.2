
<h2>Pages</h2>

<div class='row'>
	<div class='col-md-4'>
		<div class='form-group'>
			{!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
		</div>
		<div class='form-group'>
			{!! Form::label('stringurl', 'URL') !!}
			{!! Form::text('stringurl', null, ['class' => 'form-control']) !!}
		</div>
		<div class='form-group'>
			{!! Form::label('tid', 'Template') !!}
			{!! Form::select('tid', $templates, '', ['class' => 'form-control']) !!}
		</div>
	</div>
	<div class='col-md-8'>
		<h3>Syntax</h3>
	</div>
	<div class='col-md-4'>
		<p>HTML and Inline Styling Only</p>
		<p>&#64;SECTION name&#64;<br />
		Input Content<br />
		&#64;ENDSECTION</p>
		<p>&#64;API id&#64;<p>
	</div>
	<div class='col-md-4'>
	</div>
	<div class="col-md-12">
		<div class='form-group'>
			{!! Form::label('datatext', 'Page Content') !!}
			{!! Form::textarea('datatext', null, ['class' => 'form-control']) !!}
		</div>
	</div>
</div>
<div class="exampleDisplay"></div>