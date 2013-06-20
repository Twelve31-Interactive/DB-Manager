			   **UPLOADING A LIST INTO THE DATABASE**
__________________________________________________________________________


- upload the properly formatted file onto the server via FTP

- Log into lists.boxofficenetworks.com/phpmyadmin  ( user: DB-manager)
	- Select the list_management database
	- Select the manage_list table
	- sit the SQL tab
	-Create an SQL load data local infile query for that file and run it 

//	Example Query
/**********************************************************************************************************************
-	LOAD DATA LOCAL INFILE 'FILE_PATH' INTO TABLE `manage_list`
-  	FIELDS TERMINATED BY 'DELIMETER'
-   LINES TERMINATED BY '\n'
-	IGNORE 1 LINES
-	    (`BusinessID` ,  `ExecutiveID` ,  `Company_Name` ,  `Full_Name` ,  `Prefix` ,  
-		 `First_Name` ,  `Middle_Initial` ,  `Last_Name` ,  `Suffix` ,  `Standardized_Title` ,  
-		 `Gender` ,  `Physical_Address_Standardized` ,  `Physical_Address_City` ,  `Physical_Address_State` ,  
-		 `CBSA_Code` , `CBSA_Description` ,  `Email` ,  `Email_Available_Indicator` ,  `URL` ,  `EMAIL_SHA1` ,  
-		 `Title_Base64` ,  `Company_Name_Base64` ,  `URL_Base64`) 
-> REWRITE THE LIST ABOVE SO IT MATCHES THE HEADER 0F THE FILE BEING INSERTED <-
/**********************************************************************************************************************

____________________________________________________________________________
							
								**T0 D0**
____________________________________________________________________________

- Exporter
	-Validate that they did not unclick all the check boxes
	-Files larger than 64MB do not export to the browser <<<<<<<<<<<<<<<<<<<<<<<<<<

- Uploader
	- Create a page for the user to FTP a file to a folder on the server
	- Write a script that checks that folder every X minutes searching for .txt files
	- For every file it finds, it will call a LOAD DATA LOCAL INFILE to insert the data into the manage_list table
	- Remove the file after the LOAD DATA LOCAL INFILE is done

- Database Viewer 
	- Create a page for Data Tables.
	- Initialize Table Tools + individual column filtering


