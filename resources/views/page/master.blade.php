<html>
	<head>
		@include('superAdmin.master.head')
	</head>
	<body>
		<div class='container'>
			<div class='row'>
				<div class='col-md-12'>
					@yield('content')
				</div>
			</div>
			<div class='row'>
			<div class='col-md-12'>
				<span class='pull-right'>Open Source: <strong><a href='https://github.com/Divinityfound/Mathison-Framework-1.2' target='_BLANK' title='Mathison Framework 1.2 Github'>MFW1.2</a></strong> ©2013-<?php echo date('y'); ?></span>
			</div>
		</div>
		</div>
		@include('superAdmin.master.bootstrap-footer')
	</body>
</html>