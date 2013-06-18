<?php
/*********************************
 *
 * doc here
 *
 ********************************/

/*
 * Get File
 *
 * @param: file to be opened 
 * @return: array of arrays, header and entries of data
 */
function getFile( $file, $delim ){

	// open file for reading
	$fileTmp = fopen( $file,"r" ) or exit("");	

	// create array for the lines of information
	$entry[] = array();
	// create counter for rows/lines
	$c = 0;
	// read file line by line
	while ( $fileLine = fgets($fileTmp) ) {
		if( $c == 0 ) {
			// get header 
			$header = explode($delim,$fileLine);	
		} else {	
			// break the line up into temp array
			$temp = explode($delim, $fileLine);
			
			// loop through for columns
			for( $i = 0; $i < count($temp); $i++ ) {
				$entry[$c-1][$i] = str_replace( "'", "\'",$temp[$i] );
			}
		}	
		// add to row counter	
		$c++;	
	}
		
	// be a good citizen and close the file
	fclose($fileTmp);

	return array( 'header' => $header, 'entry' => $entry );
}

/*
 * Get Header
 *
 * @param: file to open, and delimiter between fields
 * @return: header array 
 *
 */
function getHeader($file, $delim) {
	// get header and entry
	$header = getFile($file, $delim);
	// assign header to header
	$header = $header['header'];
	// return header
	return $header;
}

/*
 * Get Entry 
 *
 * @param: file to open, and delimiter between fields
 * @return: entry array 
 *
 */
function getEntry($file, $delim) {
	// get entry and header
	$entry = getFile($file, $delim);
	// assign entry to entry
	$entry = $entry['entry'];
	// return entry
	return $entry;
}
