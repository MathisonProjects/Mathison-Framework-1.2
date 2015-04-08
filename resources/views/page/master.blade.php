<html>
	<head>
		@include('superAdmin.head')
	</head>
	<body>
		<div class='container'>
			<div class='row'>
				<div class='col-md12'>
					@yield('content')
				</div>
			</div>
		</div>
		@include('superAdmin.bootstrap-footer')
	</body>
</html>