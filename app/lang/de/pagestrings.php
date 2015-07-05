<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Text strings in web site
    |--------------------------------------------------------------------------
    |
    | The following strings are used for all the system generated text
    |
    */
    //Login
    "login_loginheader"     => "TaBEA | Anmeldung",
    "login_login"           => "Anmelden",
    "login_error"           => "dam|error|E-Mail und/oder Passwort falsch.",

    "welcome"               => "über die Navigation oben können Sie Studien auswählen, Zugriffsanfragen bearbeiten oder Ihr Passwort ändern.",

    //Logout
    "logout_success"        => "dam|success|Abmeldung erfolgreich.",

    //Top Menu
    "top_menu_home"         => "Home",
    "top_menu_studies"      => "Studien",
    "top_menu_requests"     => "Zugriffsanfragen",
    "top_menu_users"        => "Benutzerverwaltung",
    "top_menu_profile"      => "Profil",
    "top_menu_logout"       => "Abmelden",

    "hello"                 => "Hallo :full_name",
    "yes"                   => "Ja",
    "no"                    => "Nein",
    "errormessage_reload"   => "Es ist ein Fehler aufgetreten. Bitte laden Sie die Seite neu",
    "editorder"             => "Reihenfolge bearbeiten",
    "back"                  => "Zurück ohne Speichern",
    //********************************************
    //Studies
    //Right_menu
    "studies_rmenu_indexlink"       => "Gesamtübersicht",
    "studies_rmenu_createlink"      => "Neue Studie",
    "studies_rmenu_mystudieslink"   => "Meine Studien",
    "studies_rmenu_studyshow"       => "Studiendaten",
    "studies_rmenu_studyedit"       => "Studie bearbeiten",
    "studies_rmenu_studyresults"    => "Studienergebnisse",
    "studies_rmenu_access"          => "Zugriffsrechte",
    "studies_rmenu_requests"        => "Zugriffsanfragen",
    "studies_rmenu_studyaccess"     => "Zugangsdaten",

    //Words
    "studies_name"                  => "Studie",
    "studies_name_long"             => "Studienname",
    "studies_name_short"            => "Kurzbezeichnung (20 Zeichen)",
    "studies_mane_short_short"      => "Kurzbezeichnung",
    "studies_author"                => "Autor",
    "studies_studypassword"         => "Studienpasswort",
    "studies_description"           => "Beschreibung (durch Probanden lesbar)",
    "studies_comment"               => "Kommentar (nur in Weboberfläche lesbar)",
    "studies_accessible_from_label"     => "Studienstart",
    "studies_accessible_until_label"    => "Studienende",
    "studies_uploadable_until_label"    => "Upload von Antwortdaten bis",
    "studies_state"                 => "Studienstatus",
    "studies_role"                  => "Zugriffsrechte",
    "studies_role_author"           => "Autor",
    "studies_role_contributor"      => "Mitwirken",
    "studies_role_reading"          => "Lesen",

    //Study States
    "studystate_design"             => "in Erstellung",
    "studystate_planned"            => "Geplant",
    "studystate_running"            => "Laufend",
    "studystate_closed"             => "Abgeschlossen",
    "studystate_archived"           => "Archiviert",

    //Studies Index
    "studies_index_header"          => "Übersicht Studien",
    "studies_state"                 => "Status",
    "studies_index_nostudies"       => "Keine Studien vorhanden",

    //My Studies
    "studies_my_header"             => "Meine Studien",
    //Studies create
    "studies_create_header"         => "Neue Studie erstellen",
    "studies_create_panelheader"    => "Studiendaten",
    "studies_create_createbutton"   => "Studie erstellen",
    "studies_create_successmessage" => "dam|success|Studie erstellt.",

    //Studies RUD
    "studies_detail_header"         => "Studie: :study_name",
    "studies_create_savebutton"     => "Studie speichern",
    "studies_edit_successmessage"   => "dam|success|Studie aktualisiert.",

    //Studies show
    "study_show_request_access"     => "Zugriff beantragen",
    "studies_show_studydetails"     => "Studiendetails",

    //Access
    "study_access_header"           => "Studie: :study_name | Zugriffsrechte",
    "study_access_readable"         => "Lesezugriff",
    "study_access_contributor"      => "Mitwirken",
    "study_access_fullname"         => "Name",
    "study_access_set"              => "Zugriffsrechte aktualisieren",
    "study_access_set_success"      => "dam|success|Zugriffsrechte erfolgreich aktualisiert.",

    //Requests
    "studies_showrequests_header"   => "Studie: :study_name | Zugriffsanfragen",
    "studies_showrequests_nostudyrequests"  => "Keine Zugriffsanfragen vorhanden",
    "studies_showrequests_fullname" => "Name",
    "studies_showrequests_email"    => "E-Mail",
    "studies_showrequests_state"    => "Status",
    "studies_showrequests_edit"     => "Bearbeiten",

    //Access Data
    "studies_accessdata_header"     => "Studie: :study_name | Zugangsdaten",
    "studies_accessdata_server"     => "Serveradresse",
    "studies_accessdata_panelheader" => "Zugangsdaten",
    "studies_accessdata_qrcode"     => "QR-Code",
    "studies_accessdata_linktoprint"    => "Druckansicht (neues Fenster)",

    //Validation
    "studies_validate_substudy_none"    => "Die Studie muss über mindestens eine Teilstudie verfügen",
    "studies_validate_surveytime_none"  => "Die Teilstudie muss über mindestens einen Erhebungszeitraum verfügen",
    "studies_validate_questiongroups_none"  => "Die Teilstudie muss über mindestens eine Fragegruppe verfügen",
    "studies_validate_questions_none"   => "Die Fragegruppe muss über mindestens eine Frage verfügen",

    //Delete
    "studies_delete_deletebutton"   => "Studie löschen",

    "studies_delete_confirm"      => 'Soll die Studie gelöscht werden?\nAlle zugehörigen Elemente (Fragegruppen, Fragen, Regeln etc.) werden ebenfalls gelöscht.',
    "studies_delete_successmessage"   => "dam|success|Studie gelöscht",
    "studies_delete_successmessage_a" => "Studie gelöscht",

    //Copy
    "studies_copy_copybutton"       => "Studie kopieren",
    "studies_copy_successmessage"   => "dam|success|Studie kopiert",

    //Results
    "studies_results_header"        => "Studienergebnisse",
    "studies_results_no_results"    => "Es liegen noch keine Erhebungsdaten vor",
    "studies_results_lastupdate"    => "Letzte Aktualisierung",
    "studies_results_subjects"      => "# Probanden",
    "studies_results_datasets"      => "# Datensets",
    "studies_results_get"           => "csv-Datei",



    //Mail access
    "studyrequest_mailaccess_subject"           => "TaBEA: Neuer Studienzugriff",
    "studyrequest_mailaccess_header"            => "Neuer Studienzugriff",
    "studyrequest_mailaccess_linkto"            => ":short_name - :study_name",
    "studyrequest_mailaccess_body"              => "Sie haben Zugriffsrechte für die Studie :study_name erhalten. Der Zugriff ist über das System unter \"Meine Studien\" oder über den folgenden link möglich: ",


    //Right_menu
    "substudies_rmenu_index"        => "Teilstudien",
    "substudies_rmenu_index_d"      => "Teilstudie",

    //********************************************
    //Substudies
    //Right_menu
    "substudies_rmenu_indexlink"       => "Gesamtübersicht",
    "substudies_rmenu_createlink"      => "Neue Teilstudie",
    "substudies_rmenu_showlink"        => "Teilstudiendaten",
    "substudies_rmenu_editlink"        => "Teilstudie bearbeiten",
    "substudies_rmenu_questiongrouplink"    => "Fragegruppen",
    "substudies_rmenu_questiongrouplink_d"  => "Fragegruppe",
    "substudies_rmenu_substudy"        => "Teilstudie",

    //Index
    "substudies_index_header"       => "Studie :study_name | Übersicht Teilstudien",
    "substudies_index_nosubstudies" => "Keine Teilstudien",

    //Substudy namestrings
    "substudies_name"                  => "Teilstudie",
    "substudies_name_long"             => "Teilstudienbezeichnung",
    "substudies_description"           => "Beschreibung (durch Probanden lesbar)",
    "substudies_comment"               => "Kommentar (nur in Weboberfläche lesbar)",
    "substudies_signal_type"           => "Signalsteuerung",
    "substudies_signal_event"          => "Ereignis",
    "substudies_signal_timefix"        => "Zeitgeber/fix",
    "substudies_signal_timeflex"       => "Zeitgeber/variabel",
    "substudies_signal_timefixtime"    => "Intervalldauer in Minuten",
    "substudies_signal_timeflextime"    => "durchschn. Intervalldauer in Minuten",

    "substudies_surveyperiod_header"   => "Erhebungszeiträume",
    "substudies_surveyperiod_none"     => "keine Erhebungszeiträume vorhanden",
    "substudies_surveyperiod_start"    => "Beginn Erhebungszeitraum",
    "substudies_surveyperiod_end"      => "Ende Erhebungszeitraum",
    "substudies_surveyperiod_start_short"    => "Beginn",
    "substudies_surveyperiod_end_short"      => "Ende",
    "short_Mo"      => "Mo",
    "short_Tu"      => "Di",
    "short_We"      => "Mi",
    "short_Th"      => "Do",
    "short_Fr"      => "Fr",
    "short_Sa"      => "Sa",
    "short_Su"      => "So",
    "short_MoFr"    => "Mo-Fr",
    "short_MoSu"    => "Mo-So",

    "substudies_surveyperiod_delete_confirm"    => "Soll der Erhebungszeitraum gelöscht werden?",
    "substudies_surveyperiod_deletemessage_a"    => "Erhebungszeitraum gelöscht.",


    //Create
    "substudies_create_header"          => "Studie :study_name | Neue Teilstudie",
    "substudies_create_panelheader"     => "Daten Teilstudie",
    "substudies_create_createbutton"    => "Teilstudie erstellen",
    "substudies_create_successmessage"  => "dam|success|Teilstudie erstellt.",

    //SHOW
    "substudies_detail_header"          => "Studie :study_name | Teilstudie :substudy_name",
    "substudies_detail_panelheader"     => "Teilstudiendaten",

    //EDIT
    "substudies_edit_header"            => "Studie :study_name | Teilstudie :substudy_name bearbeiten",
    "substudies_edit_panelheader"       => "Teilstudie bearbeiten",
    "substudies_edit_editbutton"        => "Teilstudie aktualisieren",
    "substudies_edit_successmessage"    => "dam|success|Teilstudie aktualisiert.",


    "substudies_edit_surveyperiod_save"     => "Zeitraum speichern",
    "substudies_edit_surveyperiod_delete"   => "Erhebungszeitraum löschen",
    "substudies_edit_surveyperiod_new"      => "Zeitraum speichern",
    "substudies_edit_surveyperiod_successmessage"   => "dam|success|Erhebungszeitraum gespeichert.",
    "substudies_edit_surveyperiod_deletemessage"    => "dam|success|Erhebungszeitraum gelöscht.",
    "substudies_edit_surveyperiod_timehint" => "<strong>Hinweis:</strong> Die Uhrzeit von Beginn/Ende Erhebungszeitraum bezieht sich auf
    jeden Tag im angegebenen Zeitraum. Zu diesen Zeiten ist somit täglich die Erfassung von Daten möglich bzw. findet hier
    die Signalauslösung statt.",

    //DELETE
    "substudy_delete_confirm"      => 'Soll die Teilstudie gelöscht werden?\nAlle zugehörigen Elemente (Fragegruppen, Fragen, Regeln etc.) werden ebenfalls gelöscht.',
    "substudy_delete_successmessage"   => "dam|success|Teilstudie gelöscht",
    "substudy_delete_successmessage_a" => "Teilstudie gelöscht",

    //********************************************
    //QuestionGroups
    //Right_menu
    "substudies_rmenu_questiongrouplinkind"    => "Gesamtübersicht",
    "substudies_rmenu_editquestiongrouporderlink"   => "Reihenfolge bearbeiten",
    "substudies_rmenu_questiongrouplinknew"    => "Neue Fragegruppe",
    "questiongroups_rmenu_showlink"            => "Fragegruppendaten",
    "questiongroups_rmenu_editlink"            => "Fragegruppe bearbeiten",
    "substudies_rmenu_showquestion"            => "Frage anzeigen",


    //QuestionGroup Namestrings
    "questiongroup_name"                  => "Fragegruppe",
    "questiongroup_name_long"             => "Fragegruppenname",
    "questiongroup_shortname"             => "Kurzname",
    "questiongroup_description"           => "Beschreibung (durch Probanden lesbar)",
    "questiongroup_comment"               => "Kommentar (nur in Weboberfläche lesbar)",
    "questiongroup_countquestions"        => "Anzahl Fragen",
    "questiongroup_randomquestionorder"   => "<strong>zufällige Fragenreihenfolge</strong>",

    //Index
    "questiongroup_index_header"            => "Teilstudie :substudy_name | Fragegruppen",
    "questiongroup_index_questiongroups"    => "Keine Fragegruppen",

    //EditOrder
    "questiongroup_editorder_header"       => "Teilstudie :substudy_name | Fragegruppen Reihenfolge bearbeiten",
    "questiongroup_editorder_successmessage"  => "dam|success|Reihenfolge der Fragegruppen aktualisiert.",
    "questiongroup_saveorderbutton"         => "Reihenfolge speichern",

    //Create
    "questiongroup_create_header"          => "Teilstudie :substudy_name | Neue Fragegruppe",
    "questiongroup_create_panelheader"     => "Daten Fragegruppe",
    "questiongroup_create_createbutton"    => "Fragegruppe erstellen",
    "questiongroup_create_successmessage"  => "dam|success|Fragegruppe erstellt.",

    //Edit
    "questiongroup_edit_header"          => "Teilstudie :substudy_name | Fragegruppe bearbeiten",
    "questiongroup_edit_panelheader"     => "Daten Fragegruppe",
    "questiongroup_edit_createbutton"    => "Fragegruppe aktualisieren",
    "questiongroup_edit_successmessage"  => "dam|success|Fragegruppe aktualisiert.",

    //Show
    "questiongroup_show_header"          => "Teilstudie :substudy_name | Fragegruppe :questiongroup_name",
    "questiongroup_show_panelheader"     => "Fragegruppendaten",
    "questiongroup_questionheader"       => "Fragen",

    //Delete
    "questiongroup_delete_confirm"       => 'Soll die Fragegruppe gelöscht werden?\nAlle zugehörigen Elemente (Fragen, Regeln etc.) werden ebenfalls gelöscht.',
    "questiongroup_delete_successmessage"   => "dam|success|Fragegruppe gelöscht",
    "questiongroup_delete_successmessage_a" => "Fragegruppe gelöscht",

    //********************************************
    //Questions
    //Right_menu
    "substudies_rmenu_newquestion"   => "Neue Frage",
    "substudies_rmenu_editquestion"  => "Frage bearbeiten",
    "substudies_rmenu_questionlink"  => "Frage",
    "substudies_rmenu_question"      => "Daten Frage",

    //Question Namestrings
    "question_shortname"             => "Kurzname",
    "question_text"                  => "Frage (angezeigter Text)",
    "question_comment"               => "Kommentar (nur in Weboberfläche lesbar)",
    "question_countquestions"        => "Anzahl Fragen",
    "question_type"                  => "Fragetyp",
    "question_answer_required"       => "<strong>Pflichtfrage <br/> (Antwort erforderlich)</strong>",
    "question_answer_required_ol"    => "<strong>Pflichtfrage (Antwort erforderlich)</strong>",
    "question_parameter"             => "Frageparameter",

    "question_typename_NUMERIC"      => "Numerisch",
    "question_typename_SLIDER"       => "Schieberegler",
    "question_typename_TEXT"         => "Text",
    "question_typename_BOOLEAN"      => "Ja/Nein",
    "question_typename_SINGLECHOICE" => "Einfachauswahl",
    "question_typename_MULTICHOICE"  => "Mehrfachauswahl",
    "question_typename_MOODMAP"      => "Moodmap",


    "question_optiongroup_LIKERT_4"  => "Likert 4",
    "question_optiongroup_LIKERT_5"  => "Likert 5",
    "question_optiongroup_LIKERT_6"  => "Likert 6",
    "question_optiongroup_LIKERT_7"  => "Likert 7",
    "question_optiongroup_LIKERT_10" => "Likert 10",
    "question_optiongroup_SELF"      => "Selbstdefiniert",

    "question_selfdef_values"        => "Auswahlwerte",
    "question_selfdef_datavalue"     => "Datenwert",
    "question_selfdef_displayvalue"  => "Anzeigewert",

    "question_min_integer"           => "Minimum",
    "question_max_integer"           => "Maximum",
    "question_min_numeric"           => "Minimum",
    "question_max_numeric"           => "Maximum",
    "question_step_numeric"          => "Schrittweite",
    "question_no_config"             => "keine weiteren Angaben erforderlich",
    "question_optiongroup"           => "Item-Typ",

    "question_choice_selfdef_info"   => "Bitte pro Zeile einen Datensatz nach dem Muster 'DATENWERT;ANZEIGETEXT' eingeben.",


    //Question Create
    "question_create_header"                => "Teilstudie :substudy_name | Neue Frage",
    "question_create_questiongroup_header"  => "Fragegruppe: :question_group",
    "question_create_panelheader"           => "Daten Frage",
    "question_create_createbutton"          => "Frage erstellen",
    "questions_create_successmessage"       => "dam|success|Frage erstellt",

    //Edit
    "question_edit_header"                  => "Teilstudie :substudy_name | Frage bearbeiten",
    "question_edit_questiongroup_header"    => "Fragegruppe: :question_group",
    "question_edit_panelheader"             => "Daten Frage",
    "question_edit_createbutton"            => "Frage aktualisieren",
    "questions_edit_successmessage"         => "dam|success|Frage aktualisiert",

    //Show
    "question_show_header"          => "Teilstudie :substudy_name | Frage anzeigen",
    "question_show_questiongroup_header"  => "Fragegruppe: :question_group",

    //Edit Order
    "question_editorder_header"         => "Teilstudie :substudy_name Fragegruppe: :question_group| Fragereihenfolge bearbeiten",
    "question_saveorderbutton"          => "Reihenfolge speichern",
    "question_editorder_successmessage"  => "dam|success|Fragereihenfolge aktualisiert.",


    //Delete
    "question_delete_confirm"               => 'Soll die Frage wirklich gelöscht werden? \nAlle zugeordneten Elemente werden ebenfalls gelöscht.',
    "questions_delete_successmessage"       => "dam|success|Frage gelöscht",
    "questions_delete_successmessage_a"     => "Frage gelöscht",


    //********************************************
    //Rules
    "rules_index_header"                => "Teilstudie :substudy_name | Regeln",
    "rules_infotext"                    => "Die Teilstudie wird nur angezeigt, wenn mindestens eine der im Folgenden aufgelisteten Bedingungen erfüllt ist.",
    "rules_no_rules_found"              => "Keine Regeln vorhanden",
    "rules_question_shortname"          => "Kurzname Frage",
    "rules_question_name"               => "Fragetext",
    "rules_questiongroup"               => "Fragegruppe",
    "rules_answer"                      => "Zielantwort",
    "rules_rmenu_showlink"              => "Regeln",
    "rules_question"                    => "Frage",
    "rules_new_panelheader"             => "Neue Regel",
    "rules_delete_confirm"              => 'Soll die Regel wirklich gelöscht werden?',
    "rules_new_createbutton"            => "Regel erstellen",
    "rules_create_successmessage"       => "dam|success|Regel erstellt",

    "rules_edit_header"                => "Teilstudie :substudy_name | Regel bearbeiten",
    "rules_edit_panelheader"            => "Regel bearbeiten",
    "rules_edit_createbutton"           => "Regel aktualisieren",
    "rules_edit_successmessage"       => "dam|success|Regel aktualisiert",

    "rules_delete_successmessage"       => "dam|success|Regel gelöscht",
    "rules_delete_successmessage_a"     => "Regel gelöscht",


    //********************************************
    //Requests
    //Right_menu
    "studyrequests_rmenu_indexlink" => "Übersicht",

    //Create
    "studyrequests_new_header"      => "Neue Zugriffsanfrage für Studie: :study_name",
    "studyrequests_new_comment"     => "Begründung/Kommentar (optional)",
    "studyrequests_new_as_contrib"  => "Als Studienmitwirkender (Schreibrechte)",
    "studyrequests_new_create"      => "Zugriffsanforderung erstellen",

    //Header
    "studyrequests_index_header"    => "Übersicht Zugriffsanfragen",
    "studyrequests_index_myRequests"            => "Meine Anfragen",
    "studyrequests_index_myResponse_needed"     => "Zu bearbeitende Anfragen",
    "studyrequests_index_no_requests"           => "Keine Anfragen vorhanden",
    "studyrequests_index_open"      => "offen",
    "studyrequests_index_denied"    => "abgelehnt",

    //Edit
    "studyrequests_edit_header"     => "Zugriffsanfrage für Studie: :study_name bearbeiten ",
    "studyrequests_edit_select_please"  => "Bitte auswählen...",
    "studyrequests_edit_select_deny"    => "Ablehnen",
    "studyrequests_edit_select_read"  => "Lesen",
    "studyrequests_edit_select_contribute"  => "Mitarbeiten",
    "studyrequests_edit_set"        => "Änderungen speichern",
    "studyrequests_edit_success"    => "dam|success|Ihre Änderungen wurden gespeichert.",

    //Create message
    "studyrequest_create_success"   => "dam|success|Zugriffsanfrage gespeichert",

    "studyrequest_mailauthor_subject"           => "TaBEA: Neue Zugriffsanfrage",
    "studyrequest_mailauthor_header"            => "Neue Zugriffsanfrage",
    "studyrequest_mailauthor_linkto"            => "Zugriffsanfrage bearbeiten",
    "studyrequest_mailauthor_body"              => "für die von Ihnen erstellte Studie :study_name liegt eine Zugriffsanfrage von :requesting_user vor. Sie können diese unter dem folgenden Link bearbeiten.",

    //Error message
    "studyrequest_create_already_access"        => "dam|error|Sie haben bereits Zugriff auf diese Studie.",
    "studyrequest_create_already_request"       => "dam|error|Für diese Studie existiert bereits eine Anfrage.",

    //Delete message
    "studyrequest_delete_success"   => "dam|succes|Zugriffsanfrage gelöscht",
    //********************************************
    //Profile page
    //Header
    "profile_header"                => "Passwort ändern",
    "panel_header"                  => "Passwort ändern",
    "profile_password"              => "neues Passwort",
    "profile_password_verify"       => "Passwort bestätigen",
    "profile_save"                  => "Speichern",

    "profile_change_password"       => "dam|message|Bitte ändern Sie das automatisch generierte Passwort.",
    "profile_password_success"      => "dam|success|Das Passwort wurde aktualisiert.",

    //********************************************
    //Admin
    //Right menu
    "users_rmenu_indexlink"         => "Übersicht",
    "users_rmenu_createlink"        => "Neuer Benutzer",

    //Words
    "users_first_name"              => "Vorname",
    "users_last_name"               => "Nachname",
    "users_email"                   => "E-Mail",
    "users_is_admin"                => "Administrator",
    "users_password"                => "Passwort",

    //Users Index
    "users_index_header"            => "Übersicht Benutzer",
    "users_index_admins"            => "Administratoren",

    //Create
    "users_create_header"           => "Neuer Benutzer",
    "users_create_header"           => "Neues Benutzerkonto erstellen",
    "users_create_create"           => "Erstellen",
    "users_create_success"          => "dam|success|Neues Nutzerkonto für :full_name erstellt",

    //Edit User
    "users_edit_header"             => "Benutzerkonto bearbeiten",
    "users_edit_save"               => "Änderungen speichern",
    "users_edit_delete"             => "Benutzerkonto löschen",
    "users_edit_success"            => "dam|success|Nutzerkonto von :name aktualisiert.",
    "users_edit_delete_sure"        => "Soll das Benutzerkonto von :name wirklich gelöscht werden?",
    "users_edit_delete_success"     => "dam|success|Benutzerkonto von :name erfolgreich gelöscht.",
    "users_edit_reset_password"     => "Passwort zurücksetzen",

    "users_edit_resend_success"     => "dam|success|Das Passwort von :name wurde zurückgesetzt.",

    //Mail reset password
    "users_mail_reset_subject"      => "Neues Passwort für TaBEA - TagebuchErhebungsAdministration",
    "users_mail_reset_header"       => "Neues Passwort",
    "users_mail_reset_salutation"   => "Hallo :full_name",
    "users_mail_reset_body"         => "Ihr Passwort für das System \"TaBEA - TagebuchErhebungsAdministration\" wurde zurückgesetzt. Sie können sich mit folgenden Zugangsdaten anmelden:",
    "users_mail_reset_url"          => "URL",
    "users_mail_reset_login"        => "Benutzername",
    "users_mail_reset_passwordreset" => "Das Passwort muss nach Anmeldung geändert werden.",


    //Mail to new user
    "users_mail_new_subject"        => "Zugangsdaten für TaBEA - TagebuchErhebungsAdministration",
    "users_mail_new_header"         => "Neues Benutzerkonto",
    "users_mail_new_salutation"     => "Hallo :full_name,",
    "users_mail_new_body"           => "für Sie wurde ein neues Benutzerkonto für das System \"TaBEA - TagebuchErhebungsAdministration\" erstellt. Sie können sich mit folgenden Zugangsdaten anmelden:",
    "users_mail_new_url"            => "URL",
    "users_mail_new_login"          => "Benutzername",
    "users_mail_new_passwordreset"  => "Das Passwort muss bei Erstanmeldung geändert werden.",

);