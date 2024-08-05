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
include(dirname(__FILE__) . "/../../../app/system.php");

xucp_pol_secure();
secure_url();

xucp_pol_secure_chief_of_police();

xucp_pol_head_logged("fas fa-book",PARAGRAPH_MANAGER_HEADER);
xucp_pol_navi_logged();
xucp_pol_content_logged("fas fa-book",PARAGRAPH_MANAGER_HEADER);
echo "
                        <div class='row align-items-center'>
                            <div class='col-md-6'>
                                <div class='mb-3'>
                                </div>
                            </div>
                            <div class='col-md-6'>
                                <div class='d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3'>
                                    <div>
                                        <a href='/vendor/staffcp/paragraph/index-add.php' class='text-primary bg-soft-primary p-2 mb-0 font-11 rounded'><i class='bx bx-plus me-1'></i> ".PARAGRAPH_MANAGER_ADD."</a>
                                    </div>
                                </div>
                            </div>
                        </div>                         
                <div class='row'>
                    <div class='col-lg-12'>
                        <div class='card'>
                            <div class='card-body'>
                                <div class=''>
                                    <div class='mb-8'>
                                        <img src='/res/themes/default/assets/images/logo-paragraph.png' alt='' class='img-thumbnail mx-auto d-block'>
                                    </div>";
                            $select_stmt = $db->prepare("SELECT * FROM xucp_police_paragraph WHERE id LIKE ?");
                            $select_stmt->execute(array("%$query%"));
                            while($paragraph_view = $select_stmt->fetch()) {
                                echo "
                                    <hr>
                                    <div class='text-center'>
                                        <div class='row'>                        
                                            <div class='col-sm-12'>
                                                <div>
                                                    <h6 class='mb-4'>".$paragraph_view['category']."</h6>
                                                    <p class='text-muted font-size-15'>".$paragraph_view['title']."</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='mt-4'>
                                        <div class='text-muted font-size-14'>
                                            <p>".xucp_format_comments($paragraph_view['description'])."</p>
                                        </div>
                                    </div>";
                            }
                            echo "
                                </div>
                            </div>
                        </div>
                    </div>
                </div>";
xucp_pol_foot_logged();