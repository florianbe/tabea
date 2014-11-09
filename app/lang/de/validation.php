<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines contain the default error messages used by
	| the validator class. Some of these rules have multiple versions such
	| as the size rules. Feel free to tweak each of these messages here.
	|
	*/

	"accepted"             => ":attribute muss akzeptiert werden.",
	"active_url"           => ":attribute ist keine gültige URL.",
	"after"                => "Das :attribute muss nach dem :date liegen.",
	"alpha"                => ":attribute darf nur aus Buchstaben bestehen.",
	"alpha_dash"           => ":attribute darf nur aus Buchstaben, Zahlen und Gedankenstriche bestehen.",
	"alpha_num"            => ":attribute darf nur aus Buchstaben und Zahlen bestehen.",
	"array"                => ":attribute muss ein Array sein.",
	"before"               => ":attribute muss vor dem :date liegen.",
	"between"              => array(
		"numeric" => ":attribute muss zwischen :min und :max liegen.",
		"file"    => ":attribute muss zwischen :min und :max kilobytes groß sein.",
		"string"  => ":attribute muss zwischen :min und :max Zeichen lang sein.",
		"array"   => ":attribute muss :min und :max Items enthalten.",
	),
	"boolean"              => ":attribute muss wahr oder falsch sein.",
	"confirmed"            => ":attribute stimmt nicht mit der Bestätigung überein.",
	"date"                 => ":attribute ist kein gültiges Datum.",
	"date_format"          => ":attribute entspricht nicht dem Format :format.",
	"different"            => ":attribute und :other dürfen nicht übereinstimmen.",
	"digits"               => ":attribute :digits stellig sein.",
	"digits_between"       => ":attribute muss :min bis :max stellig sein.",
	"email"                => ":attribute muss eine gültige E-Mail Adresse sein.",
	"exists"               => ":attribute ist nicht gültig.",
	"image"                => ":attribute muss ein Bild sein.",
	"in"                   => "Die Auswahl :attribute ist ungültig.",
	"integer"              => ":attribute muss eine Ganzzahl sein.",
	"ip"                   => ":attribute muss eine gültige IP Adresse sein.",
	"max"                  => array(
		"numeric" => ":attribute darf nicht größer als :max sein.",
		"file"    => "Die Dateigröße von :attribute darf :max kilobytes nicht überschreiten.",
		"string"  => ":attribute darf nicht länger als :max Zeichen sein.",
		"array"   => ":attribute darf nicht mehr als :max items enthalten.",
	),
	"mimes"                => ":attribute muss vom Dateityp: :values sein.",
	"min"                  => array(
		"numeric" => ":attribute muss größer als :min sein.",
		"file"    => "Die Dateigröße von :attribute muss mindestens :min kilobytes betragen.",
		"string"  => ":attribute muss mindestens :min Zeichen lang sein.",
		"array"   => ":attribute muss mindestens :min items enthalten.",
	),
	"not_in"               => ":attribute ist keine gülige Auswahl.",
	"numeric"              => ":attribute muss eine Zahl sein.",
	"regex"                => "Das Format von :attribute ist nicht gültig.",
	"required"             => ":attribute ist ein Pflichtfeld.",
	"required_if"          => ":attribute ist ein Pflichtfeld wenn :other den Wert :value hat.",
	"required_with"        => ":attribute ist ein Pflichtfeld wenn :values vorhanden ist.",
	"required_with_all"    => ":attribute ist ein Pflichtfeld wenn :values vorhanden ist.",
	"required_without"     => ":attribute wenn :values nicht vorhanden ist.",
	"required_without_all" => ":attribute ist Pflichtfeld wenn :values nicht vorhanden sind.",
	"same"                 => ":attribute und :other müssen übereinstimmen.",
	"size"                 => array(
		"numeric" => ":attribute muss :size sein.",
		"file"    => ":attribute muss :size kilobytes groß sein.",
		"string"  => ":attribute muss :size Zeichen lang sein.",
		"array"   => ":attribute muss :size items enthalten.",
	),
	"unique"               => ":attribute wurde bereits gewählt.",
	"url"                  => "Das Format von :attribute ist nicht gültig.",
	"timezone"             => ":attribute muss eine gültige Zeitzone sein.",

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| Here you may specify custom validation messages for attributes using the
	| convention "attribute.rule" to name the lines. This makes it quick to
	| specify a specific custom language line for a given attribute rule.
	|
	*/

	'custom' => array(
		'attribute-name' => array(
			'rule-name' => 'custom-message',
		),
	),

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Attributes
	|--------------------------------------------------------------------------
	|
	| The following language lines are used to swap attribute place-holders
	| with something more reader friendly such as E-Mail Address instead
	| of "email". This simply helps us make messages a little cleaner.
	|
	*/

	'attributes' => array(),

);
