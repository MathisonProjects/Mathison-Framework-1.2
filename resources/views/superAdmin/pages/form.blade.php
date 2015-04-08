
<h2>Pages</h2>
{!! Form::open(['url'=>'admin/super/pages/']) !!}

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
		<p>HTML and Inline Styling Only</p>
		<p>Line breaks create automatic breaks</p>
	</div>
	<div class="col-md-12">
		<div class='form-group'>
			{!! Form::label('datatext', 'Page Content') !!}
			{!! Form::textarea('datatext', null, ['class' => 'form-control']) !!}
		</div>
	</div>
</div>
{!! Form::close() !!}
<div class="exampleDisplay"></div>