<?php

// --------------------------------------------
// Database Configuration
// All of your system's database configuration settings go in here.
// You can see a list of the default settings in craft/app/etc/config/defaults/db.php
// --------------------------------------------

$customDbConfig = array(

	// --------------------------------------------
	// Live Database Info. Shared with dev site most of the time.
	// Override below if necessary.
	// --------------------------------------------

    '*' => array(
		'server' => '',
        'user' => '',
        'password' => '',
        'database' => '',
        'tablePrefix' => 'craft'
    ),
    // Fix to make Craft work with MySQL 5.7.5+
    [
        "initSQLs" => [
            "SET SESSION sql_mode='STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';"
        ],
    ],
);


// --------------------------------------------
// MERGE IN LOCAL CONFIG FILE IF IT EXISTS
// --------------------------------------------

if (is_array($customLocalDbConfig = @include(CRAFT_CONFIG_PATH . 'local/db.php')))
{
	$customGlobalDbConfig = array_merge($customDbConfig['*'], $customLocalDbConfig);
	$customDbConfig['*'] = $customGlobalDbConfig;
}

return $customDbConfig;
