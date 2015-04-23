<?php

return array(
    //Database settings => database.php
    'db_default_db'    => 'mysql',

    'db_driver'    => 'mysql',
    'db_host'      => 'localhost',
    'db_database'  => 'tabea',
    'db_username'  => 'tabea',
    'db_password'  => 'tabea',
    'db_charset'   => 'utf8',
    'db_collation' => 'utf8_unicode_ci',
    'db_prefix'    => 'tab_',

    //Mail settings => mail.php
    'mail_driver'       => 'smtp',
    'mail_host'         => 'smtp.gmail.com',
    'mail_port'         => 587,
    'mail_from'         => array('address' => 'tabea.testsystem@gmail.com', 'name' => 'TaBEA - TAgeBuchErhebungsAdministration'),
    'mail_encryption'   => 'tls',
    'mail_username'     => 'tabea.testsystem@gmail.com',
    'mail_password'     => 'OttoFriedrich2014',
    'mail_sendmail'     => '/usr/sbin/sendmail -bs', //optional - only if sendmail is used

    //Admin user settings => for startup/installation
    'admin_mail'        => 'florian.binoeder@gmail.com',
    'admin_firstname'   => 'Florian',
    'admin_lastname'    => 'Binoeder',
    'admin_password'    => 'password',
);