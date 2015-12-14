<div class='row'>
	<div class='col-md-4'>
		<div class='form-group'>
			{!! Form::label('cid', 'Credential Key') !!}
			{!! Form::select('cid', $credentials, null, ['class' => 'form-control']) !!}
		</div>
		<div class='form-group'>
			{!! Form::label('full_name', 'Full Name') !!}
			{!! Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'Ex: John']) !!}
			{!! Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'Ex: Doe']) !!}
		</div>
		<div class='form-group'>
			{!! Form::label('address', 'Address') !!}
			{!! Form::text('address_street', null, ['class' => 'form-control', 'placeholder' => 'Street: 123 Main state']) !!}
			{!! Form::text('address_city', null, ['class' => 'form-control', 'placeholder' => 'City: Cooltown']) !!}
			{!! Form::text('address_state', null, ['class' => 'form-control', 'placeholder' => 'State: St']) !!}
			{!! Form::text('address_zip', null, ['class' => 'form-control', 'placeholder' => 'Zip: 55555']) !!}
			{!! Form::text('address_phone', null, ['class' => 'form-control', 'placeholder' => 'Phone: 555-555-5555']) !!}
			{!! Form::text('address_email', null, ['class' => 'form-control', 'placeholder' => 'Email: example@example.com']) !!}
		</div>

		<ul class="nav nav-tabs">
		  <li class="active"><a data-toggle="tab" href="#cc">Credit Card</a></li>
		  <li><a data-toggle="tab" href="#bank">Bank Account</a></li>
		</ul>

		<div class="tab-content">
		  <div id="cc" class="tab-pane fade in active">
			<div class='form-group'>
				{!! Form::label('card_number', 'Debit/Credit Card Number') !!}
				{!! Form::text('card_number', null, ['class' => 'form-control', 'placeholder' => '6555-5555-5555-5555']) !!}
			</div>
			<div class='form-group'>
				{!! Form::label('ccv', 'CCV') !!}
				{!! Form::text('ccv', null, ['class' => 'form-control', 'placeholder' => '3-4 Digit Code on Back of Card']) !!}
			</div>
			<div class='form-group'>
				{!! Form::label('expiration', 'Expiration Date') !!}
				{!! Form::select('expiration_month', array('',
					'01' => '01 - January',
					'02' => '02 - February',
					'03' => '03 - March',
					'04' => '04 - April',
					'05' => '05 - May',
					'06' => '06 - June',
					'07' => '07 - July',
					'08' => '08 - August',
					'09' => '09 - September',
					'10' => '10 - October',
					'11' => '11 - November',
					'12' => '12 - December'), null, ['class' => 'form-control']) !!}
				{!! Form::select('expiration_year', array('',
					'16' => '2016',
					'17' => '2017',
					'18' => '2018',
					'19' => '2019',
					'20' => '2020',
					'21' => '2021',
					'22' => '2022',
					'23' => '2023',
					'24' => '2024'), null, ['class' => 'form-control']) !!}
			</div>
		  </div>
		  <div id="bank" class="tab-pane fade">
			<div class='form-group'>
				{!! Form::label('bankName', 'Bank Name') !!}
				{!! Form::text('bankName', null, ['class' => 'form-control', 'placeholder' => 'Ex: Wells Fargo']) !!}
			</div>
			<div class='form-group'>
				{!! Form::label('accountType', 'Account Type') !!}
				{!! Form::select('accountType', array('', 'checking' => 'Checking', 'savings' => 'Savings', 'businessChecking' => 'Business Checking'), null, ['class' => 'form-control', 'placeholder' => 'Checking']) !!}
			</div>
			<div class='form-group'>
				{!! Form::label('accountNumber', 'Account Number') !!}
				{!! Form::text('accountNumber', null, ['class' => 'form-control', 'placeholder' => 'Account Number (10 Characters)']) !!}
			</div>
			<div class='form-group'>
				{!! Form::label('routingNumber', 'Routing Number') !!}
				{!! Form::text('routingNumber', null, ['class' => 'form-control', 'placeholder' => 'Routing Number (9 Characters)']) !!}
			</div>
		  </div>
		</div>

		<div class='form-group'>
			{!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
		</div>
	</div>
</div>