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

xucp_pol_head_logged("fas fa-book",PARAGRAPH_HEADER);
xucp_pol_navi_logged();
xucp_pol_content_logged("fas fa-book",PARAGRAPH_HEADER);
echo "                     
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