
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
			{!! Form::label('lpType', 'Landing Page Type') !!}
			{!! Form::select('lpType', array('' => '', 'video' => 'Video', 'ecommerce' => 'E-Commerce', 'leadCapture' => 'Lead Capture'), null, ['class' => 'form-control', 'id' => 'lpType']) !!}
		</div>
		<div class='form-group'>
			{!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
		</div>
	</div>
</div>
{!! Form::close() !!}

<div class='row'>
		@include('superAdmin.modules.landingPages.landingPageTypes.video')
		@include('superAdmin.modules.landingPages.landingPageTypes.ecommerce')
		@include('superAdmin.modules.landingPages.landingPageTypes.leadCapture')
</div>

<script type="text/javascript">
	$('#video').hide();
	$('#ecommerce').hide();
	$('#leadCapture').hide();

	$('#v_background').keyup(function() {
		$('#landingPage').css('background-image', 'url('+$('#v_background').val()+')');
	});

	$('#v_logo').keyup(function() {
		$('#logoPlaceholder').html('<img src="'+$('#v_logo').val()+'" class="col-md-12" />');
	});

	$('#v_headline').keyup(function() {
		$('#headlinePlaceholder').html('<h1>'+$('#v_headline').val()+'</h1>');
	});

	$('#lpType').change(function() {
		$('#video').hide();
		$('#ecommerce').hide();
		$('#leadCapture').hide();
		if ($('#lpType').val() == 'video') {
			$('#video').show();
		} else if ($('#lpType').val() == 'ecommerce') {
			$('#ecommerce').show();
		} else if ($('#lpType').val() == 'leadCapture') {
			$('#leadCapture').show();
		}
	});
</script>