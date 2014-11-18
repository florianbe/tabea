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
    //Top Menu
    "top_menu_home" => "Home",
    "top_menu_studies" => "Studien",
    "top_menu_requests" => "Berechtigungsanfragen",
    "top_menu_users" => "Benutzerverwaltung",
    "top_menu_profile" => "Profil",
    "top_menu_logout" => "Abmelden",

    "hello" => "Hallo :full_name",
    //********************************************
    //Studies
    //Right_menu
    "studies_rmenu_indexlink" => "Übersicht",
    "studies_rmenu_createlink" => "Neue Studie",
    "studies_rmenu_mystudieslink" => "Meine Studien",

    //Words
    "studies_name" => "Studie",
    "studies_name_long" => "Studienname",
    "studies_name_short" => "Kurzbezeichnung (20 Zeichen)",
    "studies_author" => "Autor",
    "studies_studypassword" => "Studienpasswort",
    "studies_description" => "Beschreibung (durch Probanden lesbar)",
    "studies_comment" => "Kommentar (nur in Weboberfläche lesbar)",
    "studies_accessible_from_label" => "Bereitstellung der Studiendaten ab",
    "studies_accessible_until_label" => "Bereitstellung der Studiendaten bis",
    "studies_uploadable_until_label" => "Upload von Antwortdaten bis",

    //Studies Index
    "studies_index_header" => "Übersicht Studien",
    "studies_state" => "Status",
    "studies_index_nostudies" => "Keine Studien vorhanden",

    //Studies create
    "studies_create_header" => "Neue Studie erstellen",
    "studies_create_panelheader" => "Studiendaten",
    "studies_create_createbutton" => "Studie erstellen",
    "studies_create_successmessage" => "dam|success|Studie erstellt.",

    //Studies show
    "study_show_request_access" => "Zugriff beantragen",


    //********************************************
    //Requests
    //Right_menu
    "studyrequests_rmenu_indexlink" => "Übersicht",

    //Header
    "studyrequests_index_header" => "Übersicht Zugriffsanfragen",
    "studyrequests_index_myRequests" => "Meine Anfragen",
    "studyrequests_index_myResponse_needed" => "Zu bearbeitende Anfragen",
    "studyrequests_index_no_requests" => "Keine Anfragen vorhanden",

    //Create message
    "studyrequest_create_success" => "dam|success|Zugriffsanfrage gespeichert",

    "studyrequest_mailauthor_subject" => "TaBEA: Neue Zugriffsanfrage",
    "studyrequest_mailauthor_header" => "Neue Zugriffsanfrage",
    "studyrequest_mailauthor_linkto" => "Zugriffsanfrage bearbeiten",
    "studyrequest_mailauthor_body" => "für die von Ihnen erstellte Studie :study_name liegt eine Zugriffsanfrage von :requesting_user vor. Sie können diese unter dem folgenden Link bearbeiten.",

    //Error message
    "studyrequest_create_already_access" => "dam|error|Für diese Studie bestehen bereits Zugriffsrechte.",
    "studyrequest_create_already_request" => "dam|error|Für diese Studie existiert bereits eine Anfrage.",
    //********************************************
    //Admin
    //Right menu
    "users_rmenu_indexlink" => "Übersicht",
    "users_rmenu_createlink" => "Neuer Benutzer",

    //Words
    "users_first_name" => "Vorname",
    "users_last_name" => "Nachname",
    "users_email" => "E-Mail",
    "users_is_admin" => "Administrator",

    //Users Index
    "users_index_header" => "Übersicht Benutzer",
    "users_index_admins" => "Administratoren",

    //Edit User
    "users_edit_header" => "Benutzerkonto bearbeiten",
    "users_edit_delete" => "Benutzerkonto löschen",
    "users_edit_delete_success_1" => "dam|success|Benutzerkonto von",
    "users_edit_delete_success_2" => " erfolgreich gelöscht."
);