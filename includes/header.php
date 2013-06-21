<?php
/**
 * Header
 *
 * @package		ListManager
 * @subpackage	Header
 * @copyright	Copyright (c) 2013, Neal Stanard
 * @since		1.0.0 
 */

// Exit if accessed directly
if( !defined( 'LISTMANAGER_DIR' ) ) exit;


global $page;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<title><?php echo ( $page ? $page . ' - ' : '' ) . LM_PRODUCT_NAME . ' v' . LM_PRODUCT_VERSION; ?></title>
		<link rel="stylesheet" type="text/css" href="assets/css/style.css" />
		<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
		<link rel="icon" type="image/png" href="assets/img/favicon.png" />
	</head>
	<body>
