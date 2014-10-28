<html lang="de">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Neues Benutzerkonto</h2>

		<div>
			Hallo {{$user->first_name}} {{$user->last_name}}, </br>

			<p>für Sie wurde ein neues Benutzerkonto für das System "TaBEA - TagebuchErhebungsAdministration" erstellt. Sie können sich mit folgenden Zugangsdaten anmelden:</p>
			<ul>
				<li>URL: {{ HTML::linkRoute('home') }}</li>
				<li>E-Mail: {{ $user->email}}</li>
				<li>Passwort: {{ $password }}</li>
			</ul>

			<p>Das Passwort muss bei Erstanmeldung geändert werden.</p>

		</div>
	</body>
</html>
