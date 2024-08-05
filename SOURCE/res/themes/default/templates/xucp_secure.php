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
 * @return void
 */
function xucp_pol_secure(): void
{
	if(!isset($_SESSION['xucp_police_secure']['secure_first']) || $_SESSION['xucp_police_secure']['secure_granted'] !== 'granted' || $_SESSION['xucp_police_secure']['xucp_police_conf_online'] !== '1') {
		xucp_pol_head_no_logged("",SECURE_SYSTEM);
		xucp_pol_content_no_logged("",SECURE_SYSTEM);
		echo "
                    <div class='row'>
                        <div class='col-xl-12'>
                            <div class='card'>
                                <div class='card-body'>
									".MSG_1."
                                </div>
                            </div>
                        </div>
                    </div>";
        xucp_pol_foot_no_logged();
        setCookie("PHPSESSID", "", 0x7fffffff,  "/");
        session_destroy();
        session_write_close();
		die();
	}  
}

/**
 * @return void
 */
function xucp_pol_secure_commander(): void
{
    if(intval($_SESSION['xucp_police_secure']['secure_staff']) < UC_CLASS_COMMANDER) {
        xucp_pol_head_no_logged("",SECURE_SYSTEM);
        xucp_pol_content_no_logged("",SECURE_SYSTEM);
        echo "
                    <div class='row'>
                        <div class='col-xl-12'>
                            <div class='card'>
                                <div class='card-body'>
									".MSG_2."
                                </div>
                            </div>
                        </div>
                    </div>";
        xucp_pol_foot_no_logged();
        setCookie("PHPSESSID", "", 0x7fffffff,  "/");
        session_destroy();
        session_write_close();
        die();
    }
}

/**
 * @return void
 */
function xucp_pol_secure_deputy_chief(): void
{
	if(intval($_SESSION['xucp_police_secure']['secure_staff']) < UC_CLASS_DEPUTY_CHIEF) {
		xucp_pol_head_no_logged("",SECURE_SYSTEM);
		xucp_pol_content_no_logged("",SECURE_SYSTEM);
		echo "
                    <div class='row'>
                        <div class='col-xl-12'>
                            <div class='card'>
                                <div class='card-body'>
									".MSG_2."
                                </div>
                            </div>
                        </div>
                    </div>";
        xucp_pol_foot_no_logged();
        setCookie("PHPSESSID", "", 0x7fffffff,  "/");
        session_destroy();
        session_write_close();
		die();		
	}
}

/**
 * @return void
 */
function xucp_pol_secure_assistant_chief(): void
{
    if(intval($_SESSION['xucp_police_secure']['secure_staff']) < UC_CLASS_CHIEF_OF_POLICE) {
        xucp_pol_head_no_logged("",SECURE_SYSTEM);
        xucp_pol_content_no_logged("",SECURE_SYSTEM);
        echo "
                    <div class='row'>
                        <div class='col-xl-12'>
                            <div class='card'>
                                <div class='card-body'>
									".MSG_2."
                                </div>
                            </div>
                        </div>
                    </div>";
        xucp_pol_foot_no_logged();
        setCookie("PHPSESSID", "", 0x7fffffff,  "/");
        session_destroy();
        session_write_close();
        die();
    }
}

/**
 * @return void
 */
function xucp_pol_secure_chief_of_police(): void
{
	if(intval($_SESSION['xucp_police_secure']['secure_staff']) < UC_CLASS_CHIEF_OF_POLICE) {
        xucp_pol_head_no_logged("",SECURE_SYSTEM);
        xucp_pol_content_no_logged("",SECURE_SYSTEM);
		echo "
                    <div class='row'>
                        <div class='col-xl-12'>
                            <div class='card'>
                                <div class='card-body'>
									".MSG_26."
                                </div>
                            </div>
                        </div>
                    </div>";
        xucp_pol_foot_no_logged();
        setCookie("PHPSESSID", "", 0x7fffffff,  "/");
        session_destroy();
        session_write_close();
		die();		
	}
}

/**
 * @return void
 */
function xucp_pol_secure_webmaster(): void
{
    if(intval($_SESSION['xucp_police_secure']['secure_staff']) < UC_CLASS_CHIEF_OF_POLICE) {
        xucp_pol_head_no_logged("",SECURE_SYSTEM);
        xucp_pol_content_no_logged("",SECURE_SYSTEM);
        echo "
                    <div class='row'>
                        <div class='col-xl-12'>
                            <div class='card'>
                                <div class='card-body'>
									".MSG_26."
                                </div>
                            </div>
                        </div>
                    </div>";
        xucp_pol_foot_no_logged();
        setCookie("PHPSESSID", "", 0x7fffffff,  "/");
        session_destroy();
        session_write_close();
        die();
    }
}