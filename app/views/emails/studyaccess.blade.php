<html lang="de">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>{{ trans('pagestrings.studyrequest_mailaccess_header') }}</h2>

		<div>
			<p>{{ Lang::get('pagestrings.hello', ['full_name' => $user_name]) . ',' }} </p>

			<p>{{Lang::get('pagestrings.studyrequest_mailaccess_body', ['study_name' => $study_name])}}</p>

            <ul>
            <li>{{ $ink_to_study }}</li>
            </ul>
		</div>
	</body>
</html>
