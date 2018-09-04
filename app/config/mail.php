<?php

return array(

	'driver' => 'smtp',

	'host' => '',

	'port' => 587,

	'from' => array('address' => 'no-reply@zjxartcc.org', 'name' => 'ZJX ARTCC No-Reply'),

	'encryption' => 'tls',

	'username' => 'no-reply@zjxartcc.org',

	'password' => '',

	'sendmail' => '/usr/sbin/sendmail -bs',

	'pretend' => false,

);
