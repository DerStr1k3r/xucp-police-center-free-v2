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

xucp_pol_head_logged("far fa-list-alt",CASES_HEADER);
xucp_pol_navi_logged();
xucp_pol_content_logged("far fa-list-alt",CASES_HEADER);

$id = $_GET['id'];
$select_stmt = $db->prepare(query: "SELECT * FROM xucp_police_act WHERE id = ".$id);
$select_stmt->execute();
$row=$select_stmt->fetch(PDO::FETCH_ASSOC);
if($select_stmt->rowCount() > 0){
    echo "
                        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
                        <script src='https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.debug.js'></script>
                        <script src='https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/2.3.4/jspdf.plugin.autotable.min.js'></script>
                        <script>
                            function getPDF() {
                                var doc = new jsPDF('p', 'pt', 'letter');
                                doc.text(20, 20, '".CASES_HEADER.": " . $row["act_file_number"]. "');
                                
                                doc.setLineWidth(1.5);
                                doc.line(20, 20, 200, 20);
                                
                                doc.addImage('/res/themes/default/assets/images/logo-sm.png', 'PNG', 455, 20, 120, 120);
                                
                                doc.setProperties({
	                                title: '".CASES_HEADER.": " . $row["act_file_number"]. "',
	                                subject: '" . $row["person_name"]. "',
	                                author: 'xUCP Police Center V2.0',
	                                keywords: 'xucp police center',
	                                creator: 'xUCP Police Center'
                                });
                                
                                // We'll make our own renderer to skip this editor
                                var specialElementHandlers = {
                                    '#editor': function (element, rendrer) {
                                        return true;
                                    },
                                    '#getPDF': function(element, renderer){
                                        return true;
                                    },
                                    '.controls': function(element, renderer){
                                        return true;
                                    }
                                };

                                doc.fromHTML($('#act-print').get(0), 20, 20, {
                                    'style': 'display: flex;-webkit-box-orient: vertical;-webkit-box-direction: normal;-ms-flex-direction: column;flex-direction: column;min-width: 0;word-wrap: break-word;background-color: #313533;background-clip: border-box;border: 1px solid #3b403d;border-radius: 0.25rem;',
                                    'width': 400, 
                                    'elementHandlers': specialElementHandlers
                                });
                                doc.save('".CASES_HEADER."-" . $row["act_file_number"]. ".pdf');
                            }
                        </script>                         
                        <div class='row align-items-center'>
                            <div class='col-md-6'>
                                <div class='mb-3'>
                                </div>
                            </div>
                            <div class='col-md-6'>
                                <div class='d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3'>
                                    <div>
                                        <a href='/vendor/factioncp/act/index-add.php' class='text-primary bg-soft-primary p-2 mb-0 font-11 rounded'><i class='bx bx-plus me-1'></i> ".CASES_ADD."</a>
                                        <button class='text-primary bg-soft-primary p-2 mb-0 font-11 rounded' onclick='getPDF()'><i class='bx bx bx-printer me-1'></i> ".CASES_PRINT."</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class='row' id='act-print'>
                            <div class='col-12'>
                                <div class='card'>
                                    <div class='card-header'>
                                        <h4 class='card-title'>".CASES_HEADER.": " . $row["act_file_number"]. "</h4>
                                    </div>
                                    <div class='card-body p-4'>
                                        <div class='row'>
                                            <div class='col-lg-6'>
                                                <div>
                                                    <div class='mb-3'>
                                                        <label for='example-text-input' class='form-label'>".CASES_FILE_NUMBER."</label>
                                                        <div class='col-sm-12 form-control'>
														    " . $row["act_file_number"]. "
														</div>
                                                    </div>
                                                    <div class='mb-3'>
                                                        <label for='example-text-input' class='form-label'>".CASES_JOB."</label>
                                                        <div class='col-sm-12 form-control'>
														    " . $row["person_job"]. "
														</div>
                                                    </div>                                                   
                                                </div>
                                            </div>

                                            <div class='col-lg-6'>
                                                <div class='mt-3 mt-lg-0'>
                                                    <div class='mb-3'>
                                                        <label for='example-text-input' class='form-label'>".CASES_PERSON_NAME."</label>
                                                        <div class='col-sm-12 form-control'>
														    " . $row["person_name"]. "
														</div>
                                                    </div>
                                                    <div class='mb-3'>
                                                        <label for='example-text-input' class='form-label'>".CASES_PERSON_PHONENUMBER."</label>
                                                        <div class='col-sm-12 form-control'>
														    " . $row["person_phonenumber"]. "
														</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='col-lg-6'>
                                                <div class='mt-3 mt-lg-0'>
                                                    <div class='mb-3'>
                                                        <label for='example-text-input' class='form-label'>".CASES_PERSON_BIRTHDAY."</label>
                                                        <div class='col-sm-12 form-control'>
														    " . $row["person_birthday"]. "
														</div>
                                                    </div>
                                                    <div class='mb-3'>
                                                        <label for='example-text-input' class='form-label'>".CASES_PERSON_GENDER."</label>
                                                        <div class='col-sm-12 form-control'>
														    " . $row["person_gender"]. "
														</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='col-lg-6'>
                                                <div class='mt-3 mt-lg-0'>
                                                    <div class='mb-3'>
                                                        <label for='example-text-input' class='form-label'>".CASES_PERSON_SIZE."</label>
                                                        <div class='col-sm-12 form-control'>
														    " . $row["person_size"]. "
														</div>
                                                    </div>
                                                    <div class='mb-3'>
                                                        <label for='example-text-input' class='form-label'>".CASES_PERSON_EYE_COLOR."</label>
                                                        <div class='col-sm-12 form-control'>
														    " . $row["person_eye_color"]. "
														</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='col-lg-6'>
                                                <div class='mt-3 mt-lg-0'>
                                                    <div class='mb-3'>
                                                        <label for='example-text-input' class='form-label'>".CASES_PERSON_HAIR_COLOR."</label>
                                                        <div class='col-sm-12 form-control'>
														    " . $row["person_hair_color"]. "
														</div>
                                                    </div>
                                                    <div class='mb-3'>
                                                        <label for='example-text-input' class='form-label'>".CASES_PERSON_MOTORCYCLE_LICENSE."</label>
                                                        <div class='col-sm-12 form-control'>
														    " . $row["person_motorcycle_license"]. "
														</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='col-lg-6'>
                                                <div class='mt-3 mt-lg-0'>
                                                    <div class='mb-3'>
                                                        <label for='example-text-input' class='form-label'>".CASES_PERSON_CAR_LICENSE."</label>
                                                        <div class='col-sm-12 form-control'>
														    " . $row["person_car_license"]. "
														</div>
                                                    </div>
                                                    <div class='mb-3'>
                                                        <label for='example-text-input' class='form-label'>".CASES_PERSON_TRUCK_LICENSE."</label>
                                                        <div class='col-sm-12 form-control'>
														    " . $row["person_truck_license"]. "
														</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='col-lg-6'>
                                                <div class='mt-3 mt-lg-0'>
                                                    <div class='mb-3'>
                                                        <label for='example-text-input' class='form-label'>".CASES_PERSON_GUN_LICENSE."</label>
                                                        <div class='col-sm-12 form-control'>
														    " . $row["person_gun_license"]. "
														</div>
                                                    </div>
                                                    <div class='mb-3'>
                                                        <label for='example-text-input' class='form-label'>".CASES_VEH_PLATE."</label>
                                                        <div class='col-sm-12 form-control'>
														    " . $row["veh_plate"]. "
														</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='col-lg-6'>
                                                <div class='mt-3 mt-lg-0'>
                                                    <div class='mb-3'>
                                                        <label for='example-text-input' class='form-label'>".CASES_VEH_NAME."</label>
                                                        <div class='col-sm-12 form-control'>
														    " . $row["veh_name"]. "
														</div>
                                                    </div>
                                                    <div class='mb-3'>
                                                        <label for='example-text-input' class='form-label'>".CASES_VEH_ALL_VEHICLES."</label>
                                                        <div class='col-sm-12 form-control'>
														    " . $row["veh_all_vehicles"]. "
														</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='col-lg-6'>
                                                <div class='mt-3 mt-lg-0'>
                                                    <div class='mb-3'>
                                                        <label for='example-text-input' class='form-label'>".CASES_MSG."</label>
                                                        <div class='col-sm-12 form-control'>
														    ".xucp_format_comments($row["act_msg"])."
														</div>
                                                    </div>	
                                                    <div class='mb-3'>
                                                        <label for='example-text-input' class='form-label'>".CASES_IS_FINISHED."</label>
                                                        <div class='col-sm-12 form-control'>
														    " . $row["act_is_finished"]. "
														</div>	
                                                    </div>                                                    												
                                                </div>
                                            </div>
                                            <div class='col-lg-6'>
                                                <div class='mt-3 mt-lg-0'>
                                                    <div class='mb-3'>
                                                        <label for='example-text-input' class='form-label'>".CASES_TESTIFY."</label>
                                                        <div class='col-sm-12 form-control'>
														    " . $row["act_testify"]. "
														</div>	
                                                    </div>
                                                    <div class='mb-3'>
                                                        <label for='example-text-input' class='form-label'>".CASES_FROM_CREATED."</label>
                                                        <div class='col-sm-12 form-control'>
														    " . $row["act_from_created"]. "
														</div>
                                                    </div>                                                    													
                                                </div>
                                            </div>                                            																		
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>";
}
xucp_pol_foot_logged();