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
xucp_pol_head_no_logged("fas fa-info-circle","404");
xucp_pol_content_no_logged("fas fa-info-circle","404");
echo "
                                <div class='card-body p-0'>
                                    <div class='tab-content'>
                                        <div class='tab-pane active p-3 text-center'>
                                            <img src='/res/themes/default/assets/images/error.svg' alt='0' class='' height='170'>
                                            <h1 class='mt-5 mb-4'>404!</h1>                                        
                                            This page doesn't exist                                           
                                        </div>
                                    </div>
                                </div>";
xucp_pol_foot_no_logged();