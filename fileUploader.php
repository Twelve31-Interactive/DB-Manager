<?php
/****************
 *
 * doc here
 *
 ****************/

// require files
require_once 'config.php';
require_once 'mysql.php';
require_once 'fileOpen.php';

/***********************************************************************
//
// - ideas -
// could wrap entire thing in a check to make sure it's the right file type
//
************************************************************************/
?>
<?php
// globals
global $header, $entry;

if( isset( $_POST['map'] ) ) {

	for( $i = 0; $i < $_POST['numFiles']; $i++){
		$fileName = '/var/tmp/saveList' . $i . '.txt';
		$count = $i + 1;
		putFile($_POST,$fileName,$count);
		unlink( $fileName );
	}	
	header( 'Location:http://192.168.1.130/1231projects/list_management/ManagerPlatform/' );
	
} else if( isset( $_POST['fileSubmit'] ) ) {

	$numFiles = count( $_FILES['uploadfile']['tmp_name'] );
	
	for( $i = 0; $i < $numFiles; $i++){
		$savePath = '/var/tmp/saveList' . $i . '.txt';
		storeFile($_FILES['uploadfile']['tmp_name'][$i],$savePath);
	}

	setcookie( "files", serialize( $_FILES ) );	
	// map the information 
	mapFile($_FILES);	

} else {
	echo '<br/><br/>';
	echo 	'<div id="uploadForm">';
	echo		'<body>';
	echo			'<form enctype="multipart/form-data" action="" method="POST">';
	echo				'Choose a file to upload: <input name="uploadfile[]" type="file" multiple="multiple" id="myFile"/><br />';
	echo				'<input type="hidden" value="true" name="fileSubmit"/>';
	echo 				'Select Delimiter: <input type="text" name="delimiter" maxlength="1" size="1"/><br/>';
	echo				'<input type="submit" value="Upload File" id="fileSubmitButton"/>';
	echo			'</form>';
	echo		'</body>';
	echo '</div>';
}

function storeFile( $tmpPath, $savePath ){
		$tempFileContent = file_get_contents( $tmpPath );
		file_put_contents( $savePath, $tempFileContent );
}

function mapFile( $fileInfo ){

		$numFiles = count( $fileInfo['uploadfile']['tmp_name'] );
		$userList = '/var/tmp/saveList0.txt';

		// open and read file	
		$header = getHeader($userList, $_POST['delimiter']);
		$entry = getEntry($userList, $_POST['delimiter']);

		$query = "SELECT COLUMN_NAME
				  FROM INFORMATION_SCHEMA.COLUMNS
				  WHERE TABLE_NAME =  'manage_list'";

		// store result from the query
		$result = getData( $query );
		// store number of rows from the database
		$rows = getRows( $query );
		// array for database options
		$options = array();
		for ( $j = 0; $j < $rows; $j++ ) {
			// store options
			$db_option = mysql_result($result,$j);
			array_push( $options, $db_option );
		}	

		// mapping form
		$selectionCount = 0;
		echo '<div id="mapForm">';
		echo '<form method="POST" action="">';
			foreach ( $header as $tempField ) {
				echo '<label for="' . $tempField . '" ><div class="tempFieldLabel">' . $tempField . '</div>
				<select id="'. $tempField .'" name="'. $tempField .'">
				<option value="none">-Select Match-</option>';
				 foreach( $options as $selection ){
					if( $selection != 'Primary' ){
						echo '<option class="optionSelection" value="'. $selection .'" '. ($selection == str_replace( array("\r","\n"), '', $tempField) ? 'selected' : "" ) .' >' . $selection . '</option>';	
					}
				 }
				echo '</select></label></br>';
			$selectionCount++;
			}
		echo '<input type="hidden" value="true" name="map"/>';
		echo '<input type="hidden" value="'. $numFiles .'" name="numFiles"/>';
		echo '<input type="hidden" value="' . $_POST['delimiter'] . '" name="delimiter"/>';
		echo '<br/>';
		echo '<input type="submit" value="Submit" id="mapSubmitButton"/>';	
		echo '</form>';
		echo '<div/>';
		echo '<br/>';
}

function putFile( $postInfo ,$fileName, $count ){

	// get the header and entry data
	$header = getHeader($fileName, $postInfo['delimiter']);
	$entry = getEntry($fileName, $postInfo['delimiter']);
	
	// count the number of fields from the text file
	$headerCount = count( $header );

	$c = 0;	
	$emailRowCount = 0;
	// find the column with the email in it 
	foreach( $header as $field ) {
		if( strtolower( $field ) == "email" ) {
			$emailRowCount = $c;
		}
		$c++;
	}

	// loop through the list of information array one row at a time
	foreach( $entry as $row ){

		// set email to the email field
		$email = $row[$emailRowCount];

		// query to see if that email is in the database already	
		$query = "SELECT * 
				  FROM manage_list
				  WHERE `Email` = '$email'";

		// if rows is more than one, the email is already in the DB
		$rows = getRows( $query );
		
		if( $rows > 0 ) {
		// the email already exists!!

		} else {
		// the email is not in the DB	

			$c = 1;
			$map = array();
			foreach( $_POST as $key => $val ){
				$$val = 'NULL';
				array_push( $map, $val );
				if( $c == $headerCount ) {
					break;
				}
				$c++;
			}

			for ( $i = 0; $i < $headerCount; $i++ ){
				if( $row[$i] == NULL ){
					$$map[$i] = 'NULL';
				} else {
					$$map[$i] = $row[$i];
				}
			}
 
			$putQuery = 'INSERT INTO `list_management`.`manage_list` (`BusinessID`, `ExecutiveID`, `Company_Name`,' .
			 			'`Full_Name`, `Prefix`, `First_Name`, `Middle_Initial`, `Last_Name`, `Suffix`, `Standardized_Title`,' .
		   	 			'`Gender`, `Physical_Address_Standardized`, `Physical_Address_City`, `Physical_Address_State`, `CBSA_Code`,' .
			 			'`CBSA_Description`, `Email`, `Email_Available_Indicator`, `URL`, `EMAIL_SHA1`, `Title_Base64`, `Company_Name_Base64`, `URL_Base64`)';
			$putQuery .= " VALUES ( '$BusinessID', '$ExecutiveID', '$Company_Name', '$Full_Name', '$Prefix', '$First_Name', '$Middle_Initial', '$Last_Name'," . 
					 " '$Suffix', '$Standardized_Title', '$Gender', '$Physical_Address_Standardized', '$Physical_Address_City', '$Physical_Address_State', '$CBSA_Code', '$CBSA_Description'," .
					 " '$Email', '$Email_Available_Indicator', '$URL', '$EMAIL_SHA1', '$Title_Base64', '$Company_Name_Base64', '$URL_Base64' )"; 
 
			// call insert, pass $query
			putData( $putQuery );	
		}
	}
}
?>
