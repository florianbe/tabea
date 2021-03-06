<html lang="de">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>{{ trans('pagestrings.users_mail_new_header') }}</h2>

		<div>
			{{ trans('pagestrings.users_mail_new_salutation', ['full_name' => $user->full_name]) }}</br>


			<p>{{ trans('pagestrings.users_mail_new_body') }}</p>
			<ul>
				<li>{{ trans('pagestrings.users_mail_new_url') }}: {{ HTML::linkRoute('home') }}</li>
				<li>{{ trans('pagestrings.users_mail_new_login') }}: {{ $user->email}}</li>
				<li>{{ trans('pagestrings.users_password') }}: {{ $password }}</li>
			</ul>

			<p>{{ trans('pagestrings.users_mail_new_passwordreset') }}</p>

		</div>
	</body>
</html>
