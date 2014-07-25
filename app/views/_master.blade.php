<!DOCTYPE html>
<html>
<head>
	<title>@yield('title','Foobooks')</title>

	<link rel='stylesheet' href='css/bootstrap.min.css' type='text/css'>
	<link rel='stylesheet' href='css/foobooks.css' type='text/css'>

	@yield('head')

</head>

<body>
	<a href='/'><img class='logo' src='<?php echo URL::asset('/images/logo@2x.png'); ?>' alt='Foobooks Logo'></a>

	@yield('content')

	@yield('body')

</body>
</html>