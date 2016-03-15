<div id='video'>
	<div class='col-md-9' id='landingPage' style='height: 100%;'>
		@include('superAdmin.modules.landingPages.landingPageExample')
	</div>
	<div class='col-md-3' id='dataCollection'>
		<div class='panel panel-default'>
			<div class='panel-heading'>Hidden</div>
			<div class='panel-body'>
				<div class='form-group'>
					{!! Form::label('background', 'Background') !!}
					{!! Form::text('background', null, ['class' => 'form-control', 'id' => 'background', 'placeholder' => 'URL for your background']) !!}
				</div>
			</div>
		</div>
		<div class='panel panel-default'>
			<div class='panel-heading'>Header</div>
			<div class='panel-body'>
				<div class='form-group'>
					{!! Form::label('logo', 'Logo') !!}
					{!! Form::text('logo', null, ['class' => 'form-control', 'id' => 'logo', 'placeholder' => 'URL for your logo']) !!}
				</div>
				<div class='form-group'>
					{!! Form::label('headline', 'Headline') !!}
					{!! Form::text('headline', null, ['class' => 'form-control', 'id' => 'headline', 'maxlength' => '28', 'placeholder' => 'What is your headline?']) !!}
				</div>
			</div>
		</div>
				
		<div class='panel panel-default'>
			<div class='panel-heading'>Ad Image</div>
			<div class='panel-body'>
				<div class='form-group'>
					{!! Form::label('adUrl', 'Ad Image URL') !!}
					{!! Form::text('adUrl', null, ['class' => 'form-control', 'id' => 'logo', 'placeholder' => 'URL for your logo']) !!}
				</div>
			</div>
		</div>

		<div class='panel panel-default'>
			<div class='panel-heading'>CTA Button</div>
			<div class='panel-body'>
				CTA URL
				Button Text
				Button Subtext
				Open Link in New Tab
			</div>
		</div>

		<div class='panel panel-default'>
			<div class='panel-heading'>Video</div>
			<div class='panel-body'>
				Embed
			</div>
		</div>

		<div class='panel panel-default'>
			<div class='panel-heading'>Footer</div>
			<div class='panel-body'>
				Terms and Conditions URL
				Open Term Link in New Tab
				Terms & Conditions
				Privacy URL
				Privacy Text
				Copyright
			</div>
		</div>

		<div class='panel panel-default'>
			<div class='panel-heading'>Social and Tracking Settings</div>
			<div class='panel-body'>
				FB Share Title
				FB Share Description
				FB Share Image URL
				Tracking Code
			</div>
		</div>

		<div class='panel panel-default'>
			<div class='panel-heading'>Google Analytics</div>
			<div class='panel-body'>
				Google Analytics Code
			</div>
		</div>
	</div>
</div>