<html>
	<head>
		@include('superAdmin.head')
	</head>
	<body>
		<div class='row'>
			<div class='col-md12'>
				<div class="row">
					<div class="col-md-10 col-md-offset-1">
						@include('superAdmin.menu')
					</div>
				</div>
				<div class="col-md-10 col-md-offset-1">
					@yield('content')
				</div>
			</div>
		</div>
		@include('superAdmin.bootstrap-footer')
	</body>
</html>