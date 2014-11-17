<html lang="de">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>{{ trans('pagestrings.studyrequest_mailauthor_header') }}</h2>

		<div>
			<p>{{ Lang::get('pagestrings.hello', ['full_name' => $author_name]) . ',' }} </p>

			<p>{{Lang::get('pagestrings.studyrequest_mailauthor_body', ['study_name' => $study_name, 'requesting_user' => $requesting_name])}}</p>

            <ul>
            <li>{{ link_torequest }}</li>
            </ul>
		</div>
	</body>
</html>
