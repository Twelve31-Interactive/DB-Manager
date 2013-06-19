<?php 
/*****************************
 *
 * MySQL functions
 *
 *****************************/
 
/*
 * Get Data
 *
 * This function connects to the database 
 *
 * @param: query for the database 
 * @return: the return from the database
 *
 */
function getData( $query ){

	// connect to the MySQL
	$linkDB = mysql_connect(DB_HOST, DB_USER, DB_PASS);
	if( !$linkDB ) {
		die('Could not connect: ' . mysql_error());
	}
	
	// select database
	$select_db = mysql_select_db(DB_NAME);
	if( !$select_db ) {
		die('Could not connect to MySQL server: ' . myqls_error());
	}	

	// query the database	
	$result = mysql_query( $query );
	if( !$result ) {
		die('Could not query database: ' . mysql_error());
	}

	// close the DB connection	
	mysql_close($linkDB);
	
	// return result
	return $result;
}

/*
 * Get Rows 
 *
 * This queries for number of rows and return it 
 *
 * @param: query for database 
 * @return: the result from the database 
 *
 */
function getRows( $query ){

	// connect to the MySQL
	$linkDB = mysql_connect(DB_HOST, DB_USER, DB_PASS);

	// check for errors
	if( !$linkDB ) {
		die('Could not connect: ' . mysql_error());
	}
	
	// select database
	$select_db = mysql_select_db(DB_NAME);

	// check for errors
	if( !$select_db ) {
		die('Could not connect to MySQL server: ' . myqls_error());
	}	
	
	$result = mysql_query( $query );
	
	// check for error
	if( !$result ) {
		die('Could not query database: ' . mysql_error());
	}

	$rows = mysql_num_rows($result);
	
	// close the DB connection	
	mysql_close($linkDB);

	// return rows
	return $rows;
}

/*
 * Put Data 
 *
 * This inserts data into the database 
 *
 * @param: query for database 
 * @return: the result from the database 
 *
 */
function putData( $query ){

	// connect to the MySQL
	$linkDB = mysql_connect(DB_HOST, DB_USER, DB_PASS);

	// check for errors
	if( !$linkDB ) {
		die('Could not connect: ' . mysql_error());
	}
	
	// select database
	$select_db = mysql_select_db(DB_NAME);

	// check for errors
	if( !$select_db ) {
		die('Could not connect to MySQL server: ' . myqls_error());
	}	
	
	$result = mysql_query( $query );
	
	// check for error
	if( !$result ) {
		die('Could not query database: ' . mysql_error());
	}

	// close the DB connection	
	mysql_close($linkDB);

	// return result
	return $result;
		
}
