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
function xucp_pol_content_no_logged(string $SITE_SUB_ICON = "", string $SITE_SUB_TITLE = ""): void
{
  echo "
        <div class='container'>
            <div class='row vh-100 d-flex justify-content-center'>
                <div class='col-12 align-self-center'>
                    <div class='row'>
                        <div class='col-lg-5 mx-auto'>
                            <div class='card xucp_no_logged'>
                                <div class='card-body p-0 auth-header-box'>
                                    <div class='text-center p-3'>
                                        <a href='/index.php' class='logo logo-admin'>
                                            <img src='/res/themes/default/assets/images/logo-sm-dark.png' height='50' alt='logo' class='auth-logo'>
                                        </a>
                                        <h4 class='mt-3 mb-1 fw-semibold text-white font-18'>".$_SESSION['xucp_police_secure']['xucp_police_conf_sname']."</h4>   
                                        <p class='text-muted  mb-0'>".$SITE_SUB_TITLE."</p>  
                                    </div>
                                </div>";
}

function xucp_pol_content_logged(string $SITE_SUB_ICON = "", string $SITE_SUB_TITLE = ""): void
{
  echo "
        <div class='page-wrapper'>
            <div class='topbar'>            
                <nav class='navbar-custom'>
                    <ul class='list-unstyled topbar-nav float-end mb-0'>                 
                        <li class='dropdown'>
                            <a class='nav-link dropdown-toggle waves-effect waves-light nav-user' data-bs-toggle='dropdown' href='#' role='button'
                                aria-haspopup='false' aria-expanded='false'>
                                <span class='ms-1 nav-user-name hidden-sm'>".$_SESSION['xucp_police_secure']['secure_char_name']."</span>
                                <img src='".$_SESSION['xucp_police_secure']['secure_avatar']."' alt='profile-user' class='rounded-circle thumb-xs' />                                 
                            </a>
                            <div class='dropdown-menu dropdown-menu-end'>
                                <a class='dropdown-item' href='#'><span><img src='".$_SESSION['xucp_police_secure']['secure_avatar']."' alt='' class='rounded-circle p-1 bg-primary'></span></a>
							    <a class='dropdown-item text-center' href='#'><span>".$_SESSION['xucp_police_secure']['secure_char_name']."</span></a>
							    <div class='dropdown-divider mb-0'></div>
                                <form action='".$_SERVER['PHP_SELF']."' method='post' enctype='multipart/form-data'>							
									<button type='submit' name='logout' class='dropdown-item text-center'>
										".XUCP_POL_LOGOUT."
									</button>							
								</form>	
                            </div>
                        </li>
                    </ul>
                    <ul class='list-unstyled topbar-nav mb-0'>                        
                        <li>
                            <button class='nav-link button-menu-mobile'>
                                <i data-feather='menu' class='align-self-center topbar-icon'></i>
                            </button>
                        </li>                            
                    </ul>                                      
                </nav>
            </div>
            <div class='page-content'>
                <div class='container-fluid'>
                    <div class='row'>
                        <div class='col-sm-12'>
                            <div class='page-title-box'>
                                <div class='row'>
                                    <div class='col'>
                                        <h4 class='page-title'>".$SITE_SUB_TITLE."</h4>
                                        <ol class='breadcrumb'>
                                            <li class='breadcrumb-item'><i class='fas fa-home'></i> ".$_SESSION['xucp_police_secure']['xucp_police_conf_sname']."</li>
                                            <li class='breadcrumb-item active'><i class='fa ".$SITE_SUB_ICON."'></i> ".$SITE_SUB_TITLE."</li>
                                        </ol>
                                    </div>
                                    <div class='col-auto align-self-center'>
                                        <a href='#' class='btn btn-sm btn-outline-primary' id='Dash_Date'>
                                            <span class='ay-name' id='Day_Name'>Today:</span>&nbsp;
                                            <span class='' id='Select_date'>Jan 11</span>
                                            <i data-feather='calendar' class='align-self-center icon-xs ms-1'></i>
                                        </a>
                                    </div>  
                                </div>                                                             
                            </div>
                        </div>
                    </div>";
}