<html>
	<head>
		@include('superAdmin.master.head')
		@yield('header')
		<style>
	    	body {
	        	padding-top: 70px;
		    }
	    </style>
	</head>
	<body>
		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	        <div class="container">
	            <div class="navbar-header">
	                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
	                    <span class="sr-only">Toggle navigation</span>
	                    <span class="icon-bar"></span>
	                    <span class="icon-bar"></span>
	                    <span class="icon-bar"></span>
	                </button>
	                <a class="navbar-brand" href="/admin/super/" title="This is MFW 1.2 (Mathison Framework 1.2), a simple solution to many rapid development problems that people may run into. The objective of MFW 1.2 is to smooth out the development process by incorporating ease of access between objects and data, mapping them efficiently and elegantly.">MFW 1.2</a>
	            </div>
	            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	                <ul class="nav navbar-nav">
	                    <li>
	                        @include('superAdmin.menu.list')
	                    </li>
	                </ul>
	            </div>
	        </div>
	    </nav>
		<div class='container'>
			<div class='row'>
				<div class='col-md12'>
					@yield('content')
				</div>
			</div>
		</div>

		<div class='row'>
			<div class='col-md-12'>
				<span class='pull-right'>Open Source: <strong><a href='https://github.com/Divinityfound/Mathison-Framework-1.2' target='_BLANK' title='Mathison Framework 1.2 Github'>MFW1.2</a></strong> ©2013-<?php echo date('y'); ?></span>
			</div>
		</div>
		@yield('modal')
		@include('superAdmin.master.bootstrap-footer')
	</body>
</html>