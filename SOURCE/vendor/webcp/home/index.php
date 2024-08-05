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
require_once(dirname(__FILE__) . "/../../../app/system.php");
secure_url();
xucp_pol_head_no_logged("fas fa-home",HOME_NOLOGGED);
xucp_pol_content_no_logged("fas fa-home",HOME_NOLOGGED);
echo "
                                <div class='card-body p-0'>
                                    <div class='tab-content'>
                                        <div class='card-header text-center'>".WELCOMETO." ".$_SESSION['xucp_police_secure']['xucp_police_conf_sname']."</div>
                                        <div class='card-group mb-3'>
                                            <div class='col-lg-6'>
                                                <div class='row'>
                                                    <div class='col-xl-12'>
                                                        <div>                        
									                        <div class='card-body'>
									                            <div class='card-header border text-center'><h4 class='card-title'>".LOGIN."</h4></div>                                   
                                                                <div class='p-4 border radius-15 text-center'>
                                                                    <i class='mdi mdi-account-arrow-right rounded-circle p-4 btn btn-secondary'></i>
                                                                    <br /><br />
                                                                    <p class='d-grid gap-2'><a href='/vendor/webcp/login/index.php' class='btn btn-secondary btn-sm'>".LOGIN_HOME." ".LOGIN."</a></p>
                                                                </div>   
                                                            </div>                            
								                        </div>
							                        </div>
						                        </div>
                                            </div>
                                            <div class='col-lg-6'>
                                                <div class='row'>
                                                    <div class='col-xl-12'>
                                                        <div>                        
									                        <div class='card-body'>
									                            <div class='card-header border text-center'><h4 class='card-title'>".REGISTER."</h4></div>                                   
                                                                <div class='p-4 border radius-15 text-center'>
                                                                    <i class='mdi mdi-account-arrow-right rounded-circle p-4 btn btn-secondary'></i>
                                                                    <br /><br />
                                                                    <p class='d-grid gap-2'><a href='/vendor/webcp/register/index.php' class='btn btn-secondary btn-sm'>".REGISTER_HOME." ".REGISTER."</a></p>
                                                                </div>   
                                                            </div>                            
								                        </div>
							                        </div>
						                        </div>
                                            </div>                                                                                                                                                                       
                                        </div>
                                    </div>
                                </div>";
xucp_pol_foot_no_logged();
