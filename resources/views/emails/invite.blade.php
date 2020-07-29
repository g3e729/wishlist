<!DOCTYPE html>
<html>
<head>
	<title>You Have Been Invited</title>
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
	<style type="text/css">
		body {
			font-family: "Lato", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
		}
	</style>
</head>
<body style="margin: 0; padding: 0;">
	<div style="width: 100%; height: 130px; background-color: #2c3e50; margin-bottom: 90px;">
		<div style="width: 50%; margin: 0 auto">
			<h1 style="margin:0; font-size: 40px; line-height: 120px;">
				<a href="{{ env('APP_URL') }}" style="text-decoration: none; color: #ffffff;">WishlistApp</a>
			</h1>
		</div>
	</div>
	<div style="width: 50%; margin: 0 auto">
		<p style="margin-bottom: 30px;">Hey!</p>
		<p style="margin-left: 10px;">You have been invited to participate <strong>{{ ucwords($wishlist_title) }}</strong> wishlist by <strong>{{ $from_name }}</strong>!</p>
		<br/>
		<a href="{{ $url }}" style="display: inline-block; font-weight: 400; color: #212529; text-align: center; vertical-align: middle; -webkit-user-select: none; -moz-user-select: none; -ms-user-select: none; user-select: none; background-color: #1bbc9b; text-decoration: none; color: #ffffff; border: 0.125rem solid transparent; padding: 0.375rem 0.75rem; font-size: 1rem; line-height: 1.5; border-radius: 0.5rem;">View Wishlist</a>
		@if(!$hasUser)
		<br/><br/>
		<p><strong>Oh! By the way!!!</strong></p>
		<p>You haven't registered yet with us!</p>
		<a href="{{ $register_url }}" style="display: inline-block; font-weight: 400; color: #212529; text-align: center; vertical-align: middle; -webkit-user-select: none; -moz-user-select: none; -ms-user-select: none; user-select: none; background-color: #1bbc9b; text-decoration: none; color: #ffffff; border: 0.125rem solid transparent; padding: 0.375rem 0.75rem; font-size: 1rem; line-height: 1.5; border-radius: 0.5rem;">Register now!</a>
		@endif
	</div>
	<div style="width: 100%; height: 130px; background-color: #2c3e50; margin-top: 130px;">
	</div>
</body>
</html>