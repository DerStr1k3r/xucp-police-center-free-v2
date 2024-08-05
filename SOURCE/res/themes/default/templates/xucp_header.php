<?php
// ************************************************************************************//
// * xUCP Police Center Free
// ************************************************************************************//
// * Author: DerStr1k3r
// ************************************************************************************//
// * Version: 2.4
// *
// * Copyright (c) 2023 - 2024 DerStr1k3r. All rights reserved.
// ************************************************************************************//
// * License Typ: GNU GPLv3
// ************************************************************************************//
if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {        
	header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
	setCookie("PHPSESSID", "", 0x7fffffff,  "/");
  	session_destroy();
	die( header( 'location: /vendor/webcp/404/index.php' ) );
}

/**
 * @param string $SITE_SUB_ICON
 * @param string $SITE_SUB_TITLE
 * @return void
 */
function xucp_pol_head_logged(string $SITE_SUB_ICON = "", string $SITE_SUB_TITLE = ""): void
{
    // starting secure urls
    secure_url();
    // starting header section
    echo "
<!DOCTYPE html>
<html lang='".$_SESSION['xucp_police_secure']['xucp_police_conf_lang']."'>
<head>
		<!-- ####################################################### -->
		<!-- #   Powered by xUCP Police Center Free V2.4           # -->
		<!-- #   Copyright (c) 2023 - 2024 DerStr1k3r.             # -->
		<!-- #   All rights reserved.                              # -->
		<!-- ####################################################### -->	
        <meta charset='utf-8' />
        <title>".$_SESSION['xucp_police_secure']['xucp_police_conf_sname']." | ".$SITE_SUB_TITLE."</title>
        <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
        <meta content='xUCP Police Center Free V2.3' name='description' />
        <meta content='DerStr1k3r.com' name='author' />
        <meta http-equiv='X-UA-Compatible' content='IE=edge' />
        <link rel='shortcut icon' href='/res/themes/default/assets/images/logo-sm.png'>
        <link href='/res/themes/default/plugins/jvectormap/jquery-jvectormap-2.0.2.css' rel='stylesheet'>
        <link href='/res/themes/default/assets/css/bootstrap.min.css' rel='stylesheet' type='text/css' />
        <link href='/res/themes/default/assets/css/icons.min.css' rel='stylesheet' type='text/css' />
        <link href='/res/themes/default/assets/css/metisMenu.min.css' rel='stylesheet' type='text/css' />
        <link href='/res/themes/default/plugins/daterangepicker/daterangepicker.css' rel='stylesheet' type='text/css' />
        <link href='/res/themes/default/assets/css/app.min.css' rel='stylesheet' type='text/css' />
        <link href='/res/themes/default/assets/css/custom.min.css' rel='stylesheet' type='text/css' />";
        header("X-XSS-Protection: 1; mode=block");
        header("X-Content-Type-Options: nosniff");
        header("Strict-Transport-Security: max-age=31536000");
        header("Referrer-Policy: origin-when-cross-origin");
        header("Expect-CT: max-age=7776000, enforce");
        header("Feature-Policy: vibrate 'self'; user-media *; sync-xhr 'self'");
    echo "
    </head>
    <body class='".$_SESSION['xucp_police_secure']['xucp_police_conf_themes']."'>";
}

/**
 * @param string $SITE_SUB_ICON
 * @param string $SITE_SUB_TITLE
 * @return void
 */
function xucp_pol_head_no_logged(string $SITE_SUB_ICON = "", string $SITE_SUB_TITLE = ""): void
{
  // starting secure urls  
  secure_url();
  // starting header section  
  echo "
<!DOCTYPE html>
<html lang='".$_SESSION['xucp_police_secure']['xucp_police_conf_lang']."'>
<head>
		<!-- ####################################################### -->
		<!-- #   Powered by xUCP Police Center Free V2.4           # -->
		<!-- #   Copyright (c) 2023 - 2024 DerStr1k3r.             # -->
		<!-- #   All rights reserved.                              # -->
		<!-- ####################################################### -->		
        <meta charset='utf-8' />
        <title>".$_SESSION['xucp_police_secure']['xucp_police_conf_sname']." | ".$SITE_SUB_TITLE."</title>
        <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
        <meta content='xUCP Police Center Free V2.4' name='description' />
        <meta content='DerStr1k3r.com' name='author' />
        <meta http-equiv='X-UA-Compatible' content='IE=edge' />
        <link rel='shortcut icon' href='/res/themes/default/assets/images/logo-sm.png'>
        <link href='/res/themes/default/plugins/jvectormap/jquery-jvectormap-2.0.2.css' rel='stylesheet'>
        <link href='/res/themes/default/assets/css/bootstrap.min.css' rel='stylesheet' type='text/css' />
        <link href='/res/themes/default/assets/css/icons.min.css' rel='stylesheet' type='text/css' />
        <link href='/res/themes/default/assets/css/metisMenu.min.css' rel='stylesheet' type='text/css' />
        <link href='/res/themes/default/assets/css/custom.min.css' rel='stylesheet' type='text/css' />
        <link href='/res/themes/default/plugins/daterangepicker/daterangepicker.css' rel='stylesheet' type='text/css' />
        <link href='/res/themes/default/assets/css/app.min.css' rel='stylesheet' type='text/css' />";
		header("X-XSS-Protection: 1; mode=block");
		header("X-Content-Type-Options: nosniff");
		header("Strict-Transport-Security: max-age=31536000");
		header("Referrer-Policy: origin-when-cross-origin");
		header("Expect-CT: max-age=7776000, enforce");
		header("Feature-Policy: vibrate 'self'; user-media *; sync-xhr 'self'");
echo "
    </head>
    <body class='account-body accountbg'>";
}