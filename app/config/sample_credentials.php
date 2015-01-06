<?php

return array(
    //Database settings => database.php
    'db_default_db'    => 'mysql',

    'db_driver'    => 'mysql',
    'db_host'      => 'localhost',
    'db_database'  => 'databasename',
    'db_username'  => 'username',
    'db_password'  => 'password',
    'db_charset'   => 'utf8',
    'db_collation' => 'utf8_unicode_ci',
    'db_prefix'    => 'tab_',

    //Mail settings => mail.php
    'mail_driver'       => 'smtp',
    'mail_host'         => 'smtp.server.com',
    'mail_port'         => 587,
    'mail_from'         => array('address' => 'sample@provider.com', 'name' => 'TaBEA - TAgeBuchErhebungsAdministration'),
    'mail_encryption'   => 'tls',
    'mail_username'     => 'sample@provider.com',
    'mail_password'     => 'supersecret',
    'mail_sendmail'     => '/usr/sbin/sendmail -bs', //optional - only if sendmail is used

    //Admin user settings => for startup/installation
    'admin_mail'        => 'sample@provider.com',
    'admin_firstname'   => 'Joe',
    'admin_lastname'    => 'Test',
    'admin_password'    => 'secret'

);