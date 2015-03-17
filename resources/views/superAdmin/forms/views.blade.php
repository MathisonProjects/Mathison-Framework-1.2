@extends('superAdmin.master')

@section('content')
	<h2>Forms</h2>
	<table class='table table-hover table-condensed'>
		<tr>
			<th style="width: 60px;text-align: center;">View</th>
			<th style="width: 60px;text-align: center;">Edit</th>
			<th style="width: 60px;text-align: center;">Delete</th>
			<th style="width: 60px;text-align: center;">ID</th>
			<th style="text-align: center;">Name</th>
			<th style="text-align: center;">Description</th>

		</tr>
	@foreach ($formList as $form)
		<tr>
			<td style="width: 60px;text-align: center;"><a href='/admin/super/viewForm/{{$form->id}}'><span class="glyphicon glyphicon-eye-open"></span></a></td>
			<td style="width: 60px;text-align: center;"><a href='/admin/super/viewForm/{{$form->id}}'><span class="glyphicon glyphicon-edit"></span></a></td>
			<td style="width: 60px;text-align: center;"><a href='/admin/super/viewForm/{{$form->id}}'><span class="glyphicon glyphicon-remove"></span></a></td>
			<td style="width: 60px;text-align: center;">{{$form->id}}</td>
			<td style="text-align: center;">{{$form->name}}</td>
			<td style="text-align: center;">{{$form->description}}</td>
		</tr>
	@endforeach
	</table>
@stop