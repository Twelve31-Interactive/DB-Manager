<?php
/**
 * Config
 *
 * The base configuration for ListManager
 *
 * This file has the following configurations: MySQL Settings and System Settings
 *
 * @package		ListManager
 * @subpackage	Config
 * @copyright	Copyright (c) 2013, Neal Stanard
 * @since		1.0.0 
 */


// Exit if accessed directly
if( !defined( 'LISTMANAGER_DIR' ) ) exit;


/**
 * MySQL Settings - You can get this info from your web host
 */

// The name of the database for DB Manager
define( 'DB_NAME', 'ListManager' );

// The MySQL username for this database
define( 'DB_USER', 'ListAdmin' );

// The MySQL password for this user
define( 'DB_PASSWORD', 'wh1t3h4t' );

// The hostname for this database
define( 'DB_HOST', 'localhost' );

// Database table prefix - Only letters, numbers and underscores please!
define( 'TABLE_PREFIX', 'db_' );


/**
 * System Settings
 */

// The name of this instance of ListManager
define( 'LM_PRODUCT_NAME', 'ListManager' );

// The current version of ListManager - YOU SHOULD NOT BE EDITING THIS!
define( 'LM_PRODUCT_VERSION', '1.0.0' );
