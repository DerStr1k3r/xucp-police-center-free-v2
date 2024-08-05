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
ob_start();

if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {        
	header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
	setCookie("PHPSESSID", "", 0x7fffffff,  "/");
  	session_destroy();
	die( header( 'location: /vendor/webcp/404/index.php' ) );
}
// ************************************************************************************//
// * Session starting
// ************************************************************************************//
$session_hash = 'sha512';
ini_set('session.use_trans_sid', FALSE);
ini_set('session.entropy_file', '/dev/urandom');
ini_set('session.hash_function', 'whirlpool');
ini_set('session.use_only_cookies', TRUE);
ini_set('session.cookie_httponly', TRUE);
ini_set('session.cookie_lifetime', 1200);
ini_set('session.cookie_secure', TRUE);
$cookieParams = session_get_cookie_params();
session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], true, true);
session_start();
session_regenerate_id(true);
// ************************************************************************************//
// * MySQL Database Connection
// ************************************************************************************//
$db_host="localhost"; //localhost server
$db_port="3306"; //localhost server port
$db_user="database username";	//database username
$db_password="database password";	//database password
$db_name="database name";	//database name
// ************************************************************************************//
// * MySQL Database Connection - Charsets
// ************************************************************************************//
$db_charset = 'utf8mb4';
// ************************************************************************************//
// * MySQL Account Data Connect
// ************************************************************************************//
$options = [
    \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
    \PDO::ATTR_EMULATE_PREPARES   => false,
];
$dsn = "mysql:host=$db_host;dbname=$db_name;charset=$db_charset;port=$db_port";
try {
    $db = new \PDO($dsn, $db_user, $db_password, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
