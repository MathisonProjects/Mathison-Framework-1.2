
<h2>Landing Page Campaign</h2>
{!! Form::open(['url'=>'admin/super/landingPages/']) !!}
{!! Form::hidden('landingPage', '') !!}
{!! Form::hidden('guid', $guid) !!}
<div class='row'>
	<div class='col-md-4'>
		<div class='form-group'>
			{!! Form::label('name', 'Landing Page Name') !!}
			{!! Form::text('name', null, ['class' => 'form-control']) !!}
		</div>
		<div class='form-group'>
			{!! Form::label('cid', 'Campaign') !!}
			{!! Form::select('cid', $campaigns, null, ['class' => 'form-control']) !!}
		</div>
		<div class='form-group'>
			{!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
		</div>
	</div>
</div>
{!! Form::close() !!}

<div class='row'>
	<div class='col-md-9'>Landing Page Test View</div>
	<div class='col-md-3' id='dataCollection'>
		<div class='form-group'>
			{!! Form::label('background', 'Background') !!}
			{!! Form::text('background', null, ['class' => 'form-control', 'id' => 'background']) !!}
		</div>
		<div class='form-group'>
			{!! Form::label('logo', 'Logo') !!}
			{!! Form::text('logo', null, ['class' => 'form-control', 'id' => 'logo']) !!}
		</div>
		<div class='form-group'>
			{!! Form::label('headline', 'Headline') !!}
			{!! Form::text('headline', null, ['class' => 'form-control', 'id' => 'headline']) !!}
		</div>
		<div class='form-group'>
			{!! Form::label('section', 'Section') !!}
			{!! Form::select('section', array('' => '', 'form' => 'Form', 'text' => 'Text', 'video' => 'Video'), null, ['class' => 'form-control', 'id' => 'section']) !!}
		</div>
		<div class='form-group'>
			<a href='javascript:void(0)' class='btn btn-primary col-md-12'>Add Section</a>
		</div>
	</div>
</div>