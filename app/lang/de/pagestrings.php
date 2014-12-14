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
    //********************************************
    //Studies
    //Right_menu
    "studies_rmenu_indexlink"       => "Gesamtübersicht",
    "studies_rmenu_createlink"      => "Neue Studie",
    "studies_rmenu_mystudieslink"   => "Meine Studien",
    "studies_rmenu_studyedit"       => "Studie bearbeiten",
    "studies_rmenu_access"          => "Zugriffsrechte",

    //Words
    "studies_name"                  => "Studie",
    "studies_name_long"             => "Studienname",
    "studies_name_short"            => "Kurzbezeichnung (20 Zeichen)",
    "studies_author"                => "Autor",
    "studies_studypassword"         => "Studienpasswort",
    "studies_description"           => "Beschreibung (durch Probanden lesbar)",
    "studies_comment"               => "Kommentar (nur in Weboberfläche lesbar)",
    "studies_accessible_from_label"     => "Bereitstellung der Studiendaten ab",
    "studies_accessible_until_label"    => "Bereitstellung der Studiendaten bis",
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

    //Right_menu
    "substudies_rmenu_index"        => "Teilstudien",

    //********************************************
    //Requests
    //Right_menu
    "studyrequests_rmenu_indexlink" => "Übersicht",

    //Create
    "studyrequests_new_header"      => "Neue Zugriffsanfrage für Studie :study_name",
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