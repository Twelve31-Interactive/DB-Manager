<?php
require_once 'config.php';
require_once 'mysql.php';

	if( isset( $_POST['exportSubmit'] ) ) {

		$timestamp = date('U');
		$header_arr = array();
		$select = "SELECT ";
		$from   = "FROM `manage_list` ";
		$where  = "WHERE ";
		$into 	= "INTO OUTFILE '/tmp/test". $timestamp .".txt'
				   FIELDS TERMINATED BY '|'
				   LINES TERMINATED BY '\r'";

		// number of table columns
		$db_count = $_POST['db_count'];

		// checkboxes were clicked
		if( isset( $_POST['checkboxes'] ) ) {
			$c = 1;
			foreach( $_POST['checkboxes'] as $key => $value ) {
				if( $c == count( $_POST['checkboxes'] ) ) {
					$select .= "`" . $key . "` ";
					array_push( $header_arr, $key );
				} else {
					$select .= "`" . $key . "`, ";
					array_push( $header_arr, $key );
				}
				$c++;
			}
		// checkboxes were NOT clicked
		} else {
			$select .= " * ";
			// <----------------- ADD -------------------------->
			// INSTEAD OF A STAR FOR ALL, ALL THE OPTIONS SHOULD BE ADDED TO THE STRING
			// and copy the options into header array	

		}

		// count checked boxes
		$searchCount = 0;
		$c = 0;
		foreach( $_POST as $key => $value ) {
			if( $c == $db_count ) {
				break;
			}
			if( $key != "checkboxes" ) {
				if( !empty( $value ) ) {
					$searchCount++;
				}
			}
			$c++;
		}	

		// build "where" string based on form search selection
		$stopCount = 0;
	   	$sc = 0;
		foreach( $_POST as $key => $value ) {
			if( $stopCount == $db_count ) {
				break;
			}
			if( $key != "checkboxes" ) {
				if( !empty( $value ) ) {
					$sc++;
					if( $sc == $searchCount ) {
						$where .= "`".$key."`" . " LIKE " . "'".$value. ( $key == 'CBSA_Code' ? "%'" : "' " );
					} else {
						$where .= "`".$key."`" . " LIKE " . "'".$value. ( $key == 'CBSA_Code' ? "%'" : "'" ) . " AND ";
					}
				}
			}
			$stopCount++;
		}	

		// if nothing was searched for
		if( $sc == 0 ) {
			$where .= '1 ';
		}
		
		// copy header array to file
		$c = 1;
		$header;
		foreach( $header_arr as $value ) {
			if( $c == count($header_arr) ) {
				// write header to file, then a newline
				$header .= $value . "\n";	
			} else {
				// write header to file with |
				$header .= $value . "|";	
			}
			$c++;
		}

		// cat the pieces into a query
		$query .= $select . $from . $where . $into;

		// query the database for the export criteria
		$data = getData( $query );	

		$header .= file_get_contents( "/tmp/test". $timestamp .".txt" );
		file_put_contents( "/tmp/test". $timestamp .".txt", $header );

		header("Content-type: application/force-download");
		header("Content-Disposition: attachment; filename='export_". $timestamp .".txt'");
		readfile("/tmp/test". $timestamp .".txt");
 		unlink("/tmp/test". $timestamp .".txt");
	
	} else {

		$colQuery = "SELECT COLUMN_NAME
				  	 FROM INFORMATION_SCHEMA.COLUMNS
				  	 WHERE TABLE_NAME =  'manage_list'";

		// store result from the query
		$result = getData( $colQuery );
		// store number of rows from the database
		$rows = getRows( $colQuery );
		// array for database options
		$options = array();
		for ( $j = 0; $j < $rows; $j++ ) {
			// store options
			$db_option = mysql_result($result,$j);
			array_push( $options, $db_option );
		}	

		echo '<div style="position: absolute; left: 35%; top: 5%;">';
		echo '<form method="POST">';
		$counter = 0;
			foreach ( $options as $tempField ) {
				if( $tempField != 'Primary' ) {
					echo '<label for="'. $tempField .'" ><div style="display: inline-block; width: 200px;">' . $tempField . '</div>
						<input type="text" name="'. $tempField .'" />
						<input type="checkbox" name="checkboxes['. $tempField .']" checked />
						</label><br/>';
					$counter++;
				}
			}
		echo '<br/>';
		echo '<input type="hidden" name="db_count" value="'. $counter .'" />';
		echo '<input type="hidden" name="exportSubmit" value="true" />';
		echo '<input type="submit" value="Submit" />';	
		echo '</form>';
		echo '</div>';

	}


/*

example query

SELECT  `Email` 
FROM  `manage_list` 
WHERE  `Physical_Address_City` LIKE  'Chicago'

*/


?>
