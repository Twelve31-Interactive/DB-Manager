<?php
/**
 * Installer
 *
 * @package		ListManager
 * @subpackage	Installer
 * @copyright	Copyright (c) 2013, Neal Stanard
 * @since		1.0.0
 */

// Exit if accessed directly
if( !defined( 'LISTMANAGER_DIR' ) ) exit;

function install_script() {
	global $mysql;

	$mysql = new MysqlConnection( DB_HOST, DB_NAME, DB_USER, DB_PASSWORD ) or die( 'MySQL connection failed!' );

	// Create MySQL database tables
	$mysql->create_table( TABLE_PREFIX . 'master_list', true )
		  ->add( new IntColumn( 'Primary' ) )
		  ->add( new PrimaryKey( 'Primary' ) )
		  ->add( new VarcharColumn( 'BusinessID', array( 'length' => 512 ) ) )
		  ->add( new VarcharColumn( 'ExecutiveID', array( 'length' => 512 ) ) )
		  ->add( new VarcharColumn( 'Company_Name', array( 'length' => 64 ) ) )
		  ->add( new VarcharColumn( 'Full_Name', array( 'length' => 64 ) ) )
		  ->add( new VarcharColumn( 'Prefix', array( 'length' => 64 ) ) )
		  ->add( new VarcharColumn( 'First_Name', array( 'length' => 64 ) ) )
		  ->add( new VarcharColumn( 'Middle_Initial', array( 'length' => 64 ) ) )
		  ->add( new VarcharColumn( 'Last_Name', array( 'length' => 64 ) ) )
		  ->add( new VarcharColumn( 'Suffix', array( 'length' => 64 ) ) )
		  ->add( new VarcharColumn( 'Standardized_Title', array( 'length' => 64 ) ) )
		  ->add( new EnumColumn( 'Gender', array( 'F', 'M' ) ) )
		  ->add( new VarcharColumn( 'Phone_Number', array( 'length' => 16 ) ) )
		  ->add( new VarcharColumn( 'Physical_Address_Standardized', array( 'length' => 64 ) ) )
		  ->add( new VarcharColumn( 'Physical_Address_City', array( 'length' => 64 ) ) )
		  ->add( new VarcharColumn( 'Physical_Address_State', array( 'length' => 64 ) ) )
		  ->add( new VarcharColumn( 'ZipCode', array( 'length' => 16 ) ) )
		  ->add( new VarcharColumn( 'Country', array( 'length' => 64 ) ) )
		  ->add( new IntColumn( 'CBSA_Code' ) )
		  ->add( new VarcharColumn( 'CBSA_Description', array( 'length' => 255 ) ) )
		  ->add( new VarcharColumn( 'Email', array( 'length' => 255 ) ) )
		  ->add( new TinyIntColumn( 'Email_Available_Indicator' ) )
		  ->add( new VarcharColumn( 'URL', array( 'length' => 255 ) ) )
		  ->add( new VarcharColumn( 'Email_SHA1', array( 'length' => 255 ) ) )
		  ->add( new VarcharColumn( 'Title_Base64', array( 'length' => 255 ) ) )
		  ->add( new VarcharColumn( 'Company_Name_Base64', array( 'length' => 255 ) ) )
		  ->add( new VarcharColumn( 'URL_Base64', array( 'length' => 255 ) ) )
		  ->execute();

	$mysql->create_table( TABLE_PREFIX . 'users', true )
		  ->add( new IntColumn( 'ID' ) )
		  ->add( new PrimaryKey( 'ID' ) )
		  ->add( new VarcharColumn( 'Username', array( 'length' => 255 ) ) )
		  ->add( new VarcharColumn( 'Email', array( 'length' => 255 ) ) )
		  ->add( new VarcharColumn( 'Password', array( 'length' => 255 ) ) )
		  ->add( new TinyIntColumn( 'Level' ) )
		  ->execute();

	try {
		$mysql->insert( TABLE_PREFIX . 'users', array(
			'Username'	=> 'admin',
			'Password'	=> MD5( 'password' ),
			'Level'		=> 5
		) );
	} catch( Exception $err ) {
		die( $err );
	}

	// Remove firstrun file so this doesn't get run again
	unlink( LISTMANAGER_DIR . 'cache/firstrun' );
}
