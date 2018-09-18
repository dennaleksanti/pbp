<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Data Register</title>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
</head>
<body>
	<br>
	<div class="container">
		<h2>Data Register</h2>
		<table class="table table-dark">
			<thead>
				<tr>
					<th scope="col">Username</th>
					<th scope="col">Email</th>
					<th scope="col">Password</th>
					<th scope="col">Repassword</th>
				</tr>
			</thead>
			<tbody>
				@if(count($register_data))
				@foreach($register_data as $register)
				<tr>
					<td>{{ $register->username}}</td>
					<td>{{ $register->email}}</td>
					<td>{{ $register->password}}</td>
					<td>{{ $register->repassword}}</td>
				</tr>
				@endforeach
				@else
				
				@endif
			</tbody>
		</table>
	</div>
</body>
</html>