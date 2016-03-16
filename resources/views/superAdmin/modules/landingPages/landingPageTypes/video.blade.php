<div id='video'>
	<div class='col-md-8' id='v_landingPage' style='height: 100%;'>
		@include('superAdmin.modules.landingPages.landingPageExample')
	</div>
	<div class='col-md-4' id='dataCollection'>
		<div class='panel panel-default'>
			<div class='panel-heading'>Hidden</div>
			<div class='panel-body'>
				<div class='form-group'>
					{!! Form::label('v_background', 'Background') !!}
					{!! Form::text('v_background', null, ['class' => 'form-control', 'id' => 'v_background', 'placeholder' => 'URL for your background']) !!}
				</div>
			</div>
		</div>
		<div class='panel panel-default'>
			<div class='panel-heading'>Header</div>
			<div class='panel-body'>
				<div class='form-group'>
					{!! Form::label('v_logo', 'Logo') !!}
					{!! Form::text('v_logo', null, ['class' => 'form-control', 'id' => 'v_logo', 'placeholder' => 'URL for your logo']) !!}
				</div>
				<div class='form-group'>
					{!! Form::label('v_headline', 'Headline') !!}
					{!! Form::text('v_headline', null, ['class' => 'form-control', 'id' => 'v_headline', 'maxlength' => '28', 'placeholder' => 'What is your headline?']) !!}
				</div>
			</div>
		</div>
				
		<div class='panel panel-default'>
			<div class='panel-heading'>Ad Image</div>
			<div class='panel-body'>
				<div class='form-group'>
					{!! Form::label('v_adUrl', 'Ad Image URL') !!}
					{!! Form::text('v_adUrl', null, ['class' => 'form-control', 'id' => 'v_adUrl', 'placeholder' => 'URL for your logo']) !!}
				</div>
			</div>
		</div>

		<div class='panel panel-default'>
			<div class='panel-heading'>CTA Button</div>
			<div class='panel-body'>
				<div class='form-group'>
					{!! Form::label('v_cta_url', 'CTA URL') !!}
					{!! Form::text('v_cta_url', null, ['class' => 'form-control', 'id' => 'v_cta_url', 'placeholder' => 'CTA URL']) !!}
				</div>
				<div class='form-group'>
					{!! Form::label('v_button_text', 'Button Text') !!}
					{!! Form::text('v_button_text', null, ['class' => 'form-control', 'id' => 'v_button_text', 'placeholder' => 'Button Text']) !!}
				</div>
				<div class='form-group'>
					{!! Form::label('v_button_subtext', 'Button Subtext') !!}
					{!! Form::text('v_button_subtext', null, ['class' => 'form-control', 'id' => 'v_button_subtext', 'placeholder' => 'Button Subtext']) !!}
				</div>
				<div class='form-group'>
					{!! Form::label('v_cta_url_new_tab', 'Open Link in New Tab') !!}
					{!! Form::checkbox('v_cta_url_new_tab', 'v_cta_url_new_tab', false, ['class' => 'form-control', 'id' => 'v_cta_url_new_tab']) !!}
				</div>
			</div>
		</div>

		<div class='panel panel-default'>
			<div class='panel-heading'>Video</div>
			<div class='panel-body'>
				{!! Form::label('v_youtube_url', 'Youtube URL') !!}
				{!! Form::text('v_youtube_url', null, ['class' => 'form-control', 'id' => 'v_youtube_url', 'placeholder' => 'Youtube URL']) !!}
			</div>
		</div>

		<div class='panel panel-default'>
			<div class='panel-heading'>Footer</div>
			<div class='panel-body'>
				<div class='form-group'>
					{!! Form::label('v_terms_and_conditions_url', 'Terms and Conditions URL') !!}
					{!! Form::text('v_terms_and_conditions_url', null, ['class' => 'form-control', 'id' => 'v_terms_and_conditions_url', 'placeholder' => 'Terms and Conditions URL']) !!}
				</div>
				<div class='form-group'>
					{!! Form::label('v_open_term_link_in_new_tab', 'Open Term Link in New Tab') !!}
					{!! Form::checkbox('v_open_term_link_in_new_tab', 'v_open_term_link_in_new_tab', false, ['class' => 'form-control', 'id' => 'v_open_term_link_in_new_tab']) !!}
				</div>
				<div class='form-group'>
					{!! Form::label('v_terms_and_conditions', 'Terms & Conditions') !!}
					{!! Form::text('v_terms_and_conditions', 'Terms & Conditions', ['class' => 'form-control', 'id' => 'v_terms_and_conditions', 'placeholder' => 'Terms & Conditions']) !!}
				</div>
				<div class='form-group'>
					{!! Form::label('v_privacy_url', 'Privacy URL') !!}
					{!! Form::text('v_privacy_url', null, ['class' => 'form-control', 'id' => 'v_privacy_url', 'placeholder' => 'Privacy URL']) !!}
				</div>
				<div class='form-group'>
					{!! Form::label('v_privacy_text', 'Privacy Text') !!}
					{!! Form::text('v_privacy_text', 'Privacy Policy', ['class' => 'form-control', 'id' => 'v_privacy_text', 'placeholder' => 'Privacy Text']) !!}
				</div>
				<div class='form-group'>
					{!! Form::label('v_copyright', 'Copyright') !!}
					{!! Form::text('v_copyright', 'All Rights Reserved ©'.date('Y'), ['class' => 'form-control', 'id' => 'v_copyright', 'placeholder' => 'Copyright']) !!}
				</div>
			</div>
		</div>

		<div class='panel panel-default'>
			<div class='panel-heading'>Social and Tracking Settings</div>
			<div class='panel-body'>
				<div class='form-group'>
					{!! Form::label('v_fb_share_title', 'FB Share Title') !!}
					{!! Form::text('v_fb_share_title', null, ['class' => 'form-control', 'id' => 'v_fb_share_title', 'placeholder' => 'FB Share Title']) !!}
				</div>
				<div class='form-group'>
					{!! Form::label('v_fb_share_description', 'FB Share Description') !!}
					{!! Form::text('v_fb_share_description', null, ['class' => 'form-control', 'id' => 'v_fb_share_description', 'placeholder' => 'FB Share Description']) !!}
				</div>
				<div class='form-group'>
					{!! Form::label('v_fb_share_image_url', 'FB Share Image URL') !!}
					{!! Form::text('v_fb_share_image_url', null, ['class' => 'form-control', 'id' => 'v_fb_share_image_url', 'placeholder' => 'FB Share Image URL']) !!}
				</div>
				<div class='form-group'>
					{!! Form::label('v_tracking_code', 'Tracking Code') !!}
					{!! Form::textarea('v_tracking_code', null, ['class' => 'form-control', 'id' => 'v_tracking_code', 'placeholder' => 'FB Tracking Code']) !!}
				</div>
			</div>
		</div>

		<div class='panel panel-default'>
			<div class='panel-heading'>Google Analytics</div>
			<div class='panel-body'>
				<div class='form-group'>
					{!! Form::label('v_google_analytics_code', 'Google Analytics Code') !!}
					{!! Form::textarea('v_google_analytics_code', null, ['class' => 'form-control', 'id' => 'v_google_analytics_code', 'placeholder' => 'Google Analytics Code']) !!}
				</div>
			</div>
		</div>
	</div>
</div>