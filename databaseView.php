<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css" />
<link rel="stylesheet" type="text/css" href="css/TableTools.css" />
<link rel="stylesheet" type="text/css" href="css/TableTools_JUI.css" />
<script src="js/jquery-1.10.1.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/jquery.dataTables.columnFilter.js"></script>
<script src="js/TableTools.min.js"></script>
<script src="js/ZeroClipboard.js"></script>
<script type="text/javascript">
var asInitVals = new Array();
$(document).ready(function() {

	var oTable = $('#marketList').dataTable( {
	"bProcessing": true,
   	"bServerSide": true,
	"sAjaxSource": "dataTables.server.process.php",
	"bStateSave": true,
	"iCookieDuration": 60*60*24*365,
	//"bFilter": false,
	} );//.columnFilter();

	$('#myFile').bind('change', function() {
		var inp = document.getElementById('myFile');
		var total = 0;
		for( var i = 0; i < inp.files.length; ++i ){
			var filesize = inp.files.item(i).size;
			total += filesize;
		}
		if( total > 8000000 ){
			alert("Files are too large!");
			document.getElementById('fileSubmitButton').style.display = 'none';
		}else{
			document.getElementById('fileSubmitButton').style.display = '';
		}
	});

} );
</script>
<?php
	echo '<div id="marketListWrapper">';
	echo '<table id="marketList">';
	echo 	'<thead>';
	echo 		'<tr>';
	echo 			'<td width=80>Business ID</td>';
	echo 			'<td width=80>Executive ID</td>';
	echo 			'<td width=400>Company Name</td>';
	echo 			'<td width=150>Full Name</td>';
	echo 			'<td width=30>Prefix</td>';
	echo 			'<td width=100>First Name</td>';
	echo 			'<td width=50>Middle Initial</td>';
	echo 			'<td width=120>Last Name</td>';
	echo 			'<td width=50>Suffix</td>';
	echo 			'<td width=200>Standard Title</td>';
	echo 			'<td width=60>Gender</td>';
	echo 			'<td width=500>Street</td>';
	echo 			'<td width=100>City</td>';
	echo 			'<td width=100>State</td>';
	echo 			'<td width=140>CBSA Code</td>';
	echo 			'<td width=600>CBSA Description</td>';
	echo 			'<td width=100>Email</td>';
	echo 			'<td width=50>EAI</td>';
	echo 			'<td width=100>URL</td>';
	echo 			'<td>Email Sha</td>';
	echo 			'<td>Title Base 64</td>';
	echo 			'<td>Company Name Base 64</td>';
	echo 			'<td>URL Base 64</td>';
	echo 		'</tr>';
	echo 	'</thead>';
	echo 	'<tbody></tbody>';
	/*echo '<tfoot>';
	echo 		'<tr>';
	echo 			'<th></th>';
	echo 			'<th></th>';
	echo 			'<th></th>';
	echo 			'<th></th>';
	echo 			'<th></th>';
	echo 			'<th></th>';
	echo 			'<th></th>';
	echo 			'<th></th>';
	echo 			'<th></th>';
	echo 			'<th></th>';
	echo 			'<th></th>';
	echo 			'<th></th>';
	echo 			'<th></th>';
	echo 			'<th></th>';
	echo 			'<th></th>';
	echo 			'<th></th>';
	echo 			'<th></th>';
	echo 			'<th></th>';
	echo 			'<th></th>';
	echo 			'<th></th>';
	echo 			'<th></th>';
	echo 			'<th></th>';
	echo 			'<th></th>';
	echo 		'</tr>';
	echo '</tfoot>';*/
	echo '</table>';
	echo '</div>';
?>
