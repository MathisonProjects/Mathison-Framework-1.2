@if (isset($menu))
	<li class="dropdown">
		<a href="#" tabindex="0" data-toggle="dropdown">Menu <i class="glyphicon glyphicon-cog"></i><span class="caret"></span></a>
		<ul class="dropdown-menu" role="menu">
			@yield('menu')
		</ul>
	</li>
@endif