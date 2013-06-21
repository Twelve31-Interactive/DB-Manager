<?php
/**
 * Login System
 *
 * @package		ListManager
 * @subpackage	Login
 * @copyright	Copyright (c) 2013, Neal Stanard
 * @since		1.0.0
 */

// Exit if accessed directly
if( !defined( 'LISTMANAGER_DIR' ) ) exit;


global $page;

$page = 'Login';

require_once LISTMANAGER_DIR . 'includes/header.php';

?>
<div id="login">
	<div id="header">
		<div id="logo"></div>
		<h1><?php echo LM_PRODUCT_NAME . ' - Login'; ?></h1>
	</div>
	<div id="body">
		<div id="head">
			<i class="icon-key"></i>
			<h2>Enter your credentials to login</h2>
			<br class="clear" />
		</div>
		<form id="login-form" method="post" action="">
			<div id="middle">
				<ul>
					<li id="usr-li">
						<input type="text" name="username" id="username" class="required" placeholder="Username" value="John Doe">
					</li>
					<li id="pwd-li">
						<input type="password" name="password" id="password" class="required error" placeholder="Password">
					</li>
				</ul>
			</div>
			<div id="bottom">
				<button type="submit" id="submit" class="button inset submit">LOGIN</button>
				<br class="clear" />
			</div>
		</form>
	</div>
</div>
