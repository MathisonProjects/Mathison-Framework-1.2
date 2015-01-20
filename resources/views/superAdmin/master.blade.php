<html>
	<head>
		@include('superAdmin.head')
		@yield('header')
	</head>
	<body>
		<div class='container'>
			<div class='row'>
				<div class='col-md12'>
					<div class="row">
						<div class="col-md-12">
							@include('superAdmin.menu')
						</div>
					</div>
					<div class="col-md-12">
						@yield('content')
					</div>
				</div>
			</div>
		</div>
		@include('superAdmin.bootstrap-footer')
	</body>
</html>