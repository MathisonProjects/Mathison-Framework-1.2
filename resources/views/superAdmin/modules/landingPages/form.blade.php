
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
	<div class='col-md-9' id='landingPage' style='height: 100%;'>
		<div class='row'>
			<div class='col-md-4' id='logoPlaceholder'></div>
			<div class='col-md-8' id='headlinePlaceholder'>Landing Page Test View</div>
		</div>
	</div>
	<div class='col-md-3' id='dataCollection'>
		<div class='form-group'>
			{!! Form::label('background', 'Background') !!}
			{!! Form::text('background', null, ['class' => 'form-control', 'id' => 'background', 'placeholder' => 'URL for your background']) !!}
		</div>
		<div class='form-group'>
			{!! Form::label('logo', 'Logo') !!}
			{!! Form::text('logo', null, ['class' => 'form-control', 'id' => 'logo', 'placeholder' => 'URL for your logo']) !!}
		</div>
		<div class='form-group'>
			{!! Form::label('headline', 'Headline') !!}
			{!! Form::text('headline', null, ['class' => 'form-control', 'id' => 'headline', 'maxlength' => '28', 'placeholder' => 'What is your headline?']) !!}
		</div>
		<div class='form-group'>
			{!! Form::label('section', 'Section') !!}
			{!! Form::select('section', array('' => '', 'form' => 'Form', 'text' => 'Text', 'video' => 'Video'), null, ['class' => 'form-control', 'id' => 'section']) !!}
		</div>
		<div class='form-group' id='form'>
			{!! Form::label('form', 'Form') !!}
			{!! Form::text('form', null, ['class' => 'form-control']) !!}
		</div>
		<div class='form-group' id='text'>
			{!! Form::label('text', 'Text') !!}
			{!! Form::text('text', null, ['class' => 'form-control']) !!}
		</div>
		<div class='form-group' id='video'>
			{!! Form::label('video', 'Youtube URL') !!}
			{!! Form::text('video', null, ['class' => 'form-control']) !!}
		</div>
		<div id='additionalSections'></div>
		<div class='form-group'>
			<a href='#' id='addSection' class='btn btn-primary col-md-12'>Add Section</a>
		</div>
	</div>
</div>

<script type="text/javascript">
	$('#form').hide();
	$('#text').hide();
	$('#video').hide();

	$('#background').keyup(function() {
		$('#landingPage').css('background-image', 'url('+$('#background').val()+')');
	});

	$('#logo').keyup(function() {
		$('#logoPlaceholder').html('<img src="'+$('#logo').val()+'" class="col-md-12" />');
	});

	$('#headline').keyup(function() {
		$('#headlinePlaceholder').html('<h1>'+$('#headline').val()+'</h1>');
	});

	$('#section').change(function() {
		$('#form').hide();
		$('#text').hide();
		$('#video').hide();
		$('#'+$("#section").val()).show();
	});
</script>