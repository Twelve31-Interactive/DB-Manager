<?php
/**
 * ****************************************************************************
 * Micro Protector
 * 
 * Version: 1.0
 * Release date: 2007-09-10
 * 
 * USAGE:
 *   Define your requested password below and inset the following code
 *   at the beginning of your page:
 *   <?php require_once("microProtector.php"); ?>
 * 
 *   See the attached example.php.
 * 
 ******************************************************************************/

$Password = array(
	'wh1t3h4t'
); // Set your password here

/******************************************************************************/
   if (isset($_POST['submit_pwd'])){
      $pass = isset($_POST['passwd']) ? $_POST['passwd'] : '';
      
      if (! in_array( $pass, $Password ) ) {
         showForm("Wrong password");
         exit();     
      }
   } else {
      showForm();
      exit();
   }
   
function showForm($error="LOGIN"){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "DTD/xhtml1-transitional.dtd">
<html>
<head>
   <title>Micro Protector</title>
   <link href="css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <div id="main">
      <div class="caption"><?php echo $error; ?></div>
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="pwd" id="microForm">
        Password:
        <table>
          <tr><td><input class="text" name="passwd" type="password"/></td></tr>
          <tr><td align="center"><br/>
             <input class="text" type="submit" name="submit_pwd" value="Login"/>
          </td></tr>
        </table>  
      </form>
   </div>
</body>       

<?php   
}
?>
