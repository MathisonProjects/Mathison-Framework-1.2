@if (isset($menu))
	<li class="dropdown">
		<a href="#" tabindex="0" data-toggle="dropdown">Menu <i class="glyphicon glyphicon-cog"></i><span class="caret"></span></a>
		<ul class="dropdown-menu" role="menu">
			@yield('menu_general')
		</ul>
	</li>
	<li class="dropdown">
		<a href="#" tabindex="0" data-toggle="dropdown">Functions <span class="caret"></span></a>
		<ul class="dropdown-menu" role="menu">
			@yield('menu_functions')
		</ul>
	</li>

@endif