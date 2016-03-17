
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
		$('#v_landingPage').css('background-image', 'url('+$('#v_background').val()+')');
	});

	$('#v_logo').keyup(function() {
		$('#v_landingPage #logoPlaceholder').html('<img src="'+$('#v_logo').val()+'" class="col-md-12" />');
	});

	$('#v_headline').keyup(function() {
		$('#v_landingPage #headlinePlaceholder').html('<h1>'+$('#v_headline').val()+'</h1>');
	});

	$('#v_adUrl').keyup(function() {

	});

	$('#v_cta_url').keyup(function() {
		$('#v_landingPage #ctaButton').html('<a href="'+$('#v_cta_url').val()+'" class="btn-primary col-md-12"><h4>'+$('#v_button_text').val()+'</h4>'+$('#v_button_subtext').val()+'</a>');
	});

	$('#v_button_text').keyup(function() {
		$('#v_landingPage #ctaButton').html('<a href="'+$('#v_cta_url').val()+'" class="btn-primary col-md-12"><h4>'+$('#v_button_text').val()+'</h4>'+$('#v_button_subtext').val()+'</a>');
	});

	$('#v_button_subtext').keyup(function() {
		$('#v_landingPage #ctaButton').html('<a href="'+$('#v_cta_url').val()+'" class="btn-primary col-md-12"><h4>'+$('#v_button_text').val()+'</h4>'+$('#v_button_subtext').val()+'</a>');
	});

	$('#v_cta_url_new_tab').click(function() {

	});

	$('#v_youtube_url').keyup(function() {

	});

	$('#v_terms_and_conditions_url').keyup(function() {
		$('#v_landingPage #termsAndConditions').html('<a href="'+$('#v_terms_and_conditions_url').val()+'">'+$('#v_terms_and_conditions').val()+'</a>');
	});

	$('#v_open_term_link_in_new_tab').click(function() {

	});

	$('#v_terms_and_conditions').keyup(function() {
		$('#v_landingPage #termsAndConditions').html('<a href="'+$('#v_terms_and_conditions_url').val()+'">'+$('#v_terms_and_conditions').val()+'</a>');
	});

	$('#v_privacy_url').keyup(function() {
		$('#v_landingPage #privacyPolicy').html('<a href="'+$('#v_privacy_url').val()+'">'+$('#v_privacy_text').val()+'</a>');
	});

	$('#v_privacy_text').keyup(function() {
		$('#v_landingPage #privacyPolicy').html('<a href="'+$('#v_privacy_url').val()+'">'+$('#v_privacy_text').val()+'</a>');
	});

	$('#v_copyright').keyup(function() {
		$('#v_landingPage #copyright').text($('#v_copyright').val());
	});

	$('#v_fb_share_title').keyup(function() {

	});

	$('#v_fb_share_description').keyup(function() {

	});

	$('#v_fb_share_image_url').keyup(function() {

	});

	$('#v_tracking_code').keyup(function() {

	});

	$('#v_google_analytics_code').keyup(function() {

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