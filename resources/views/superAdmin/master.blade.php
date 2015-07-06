<html>
	<head>
		@include('superAdmin.master.head')
		@yield('header')
	</head>
	<body>
		<div class='container'>
			<div class='row'>
				<div class='col-md12'>
					<div class="row">
						<div class="col-md-12">
							@include('superAdmin.menu.list')
						</div>
					</div>
					<div class="col-md-12">
						@yield('content')
					</div>
				</div>
			</div>
		</div>
		@yield('modal')
		@include('superAdmin.master.bootstrap-footer')
	</body>
</html>