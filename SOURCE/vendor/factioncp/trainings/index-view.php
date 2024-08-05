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

xucp_pol_secure_deputy_chief();

xucp_pol_head_logged("far fa-life-ring",TRAIN_HEADER);
xucp_pol_navi_logged();
xucp_pol_content_logged("far fa-life-ring",TRAIN_HEADER);

$id = $_GET['id'];
$select_stmt = $db->prepare(query: "SELECT * FROM xucp_police_trainings WHERE id = ".$id);
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
                                doc.text(20, 20, '".TRAIN_HEADER.": " . $row["train_title"]. "');
                                
                                doc.setLineWidth(2.5);
                                doc.line(20, 20, 400, 20);
                                
                                doc.addImage('/res/themes/default/assets/images/logo-sm.png', 'PNG', 455, 20, 120, 120);
                                
                                doc.setProperties({
	                                title: '".TRAIN_HEADER.": " . $row["train_title"]. "',
	                                subject: '" . $row["person"]. "',
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

                                doc.fromHTML($('#train-print').get(0), 20, 20, {
                                    'style': 'display: flex;-webkit-box-orient: vertical;-webkit-box-direction: normal;-ms-flex-direction: column;flex-direction: column;min-width: 0;word-wrap: break-word;background-color: #313533;background-clip: border-box;border: 1px solid #3b403d;border-radius: 0.25rem;',
                                    'width': 400, 
                                    'elementHandlers': specialElementHandlers
                                });
                                doc.save('".TRAIN_HEADER."-" . $row["train_title"]. ".pdf');
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
                                        <a href='/vendor/factioncp/trainings/index-add.php' class='text-primary bg-soft-primary p-2 mb-0 font-11 rounded'><i class='bx bx-plus me-1'></i> ".TRAIN_ADD."</a>
                                        <button class='text-primary bg-soft-primary p-2 mb-0 font-11 rounded' onclick='getPDF()'><i class='bx bx bx-printer me-1'></i> ".TRAIN_PRINT."</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div class='row' id='train-print'>
                        <div class='col-lg-12'>
                            <div class='card'>
					            <div class='card-body'>
						            <input type='hidden' name='new' value='1' />
                                        <div class='form-group'>
								            <div class='form-line'>
									            <label  class='col-sm-3 col-form-label'>".TRAIN_ADD_TITLE."</label>
									            <div class='col-sm-12 form-control'>
                                                    " . $row["train_title"]. "
									            </div>
								            </div>
                                        </div>
                                        <div class='form-group'>
								            <div class='form-line'>
									            <label  class='col-sm-3 col-form-label'>".TRAIN_ADD_TYPE."</label>
									            <div class='col-sm-12 form-control'>
                                                    " . $row["train_type"]. "
									            </div>
								            </div>							
                                        </div>
                                        <div class='form-group'>
								            <div class='form-line'>
									            <label  class='col-sm-3 col-form-label'>".TRAIN_ADD_CONTENT."</label>
									            <div class='col-sm-12 form-control'>
									                ".xucp_format_comments($row["train_content"])."
									            </div>
								            </div>							
                                        </div>
                                        <div class='form-group'>
								            <div class='form-line'>
									            <label  class='col-sm-3 col-form-label'>".TRAIN_ADD_PERSON."</label>
									            <div class='col-sm-12 form-control'>
									                ".xucp_format_comments($row["train_persons"])."									
									            </div>
								            </div>							
                                        </div>
                                        <div class='form-group'>
								            <div class='form-line'>
									            <label  class='col-sm-3 col-form-label'>".TRAIN_ADD_WHEN."</label>
									            <div class='col-sm-12 form-control'>
                                                    ".$row["train_when"]."
									            </div>
								            </div>							
                                        </div>						
						            </input>
						        </div>							
					        </div>
				        </div>
                    </div>";
}
xucp_pol_foot_logged();