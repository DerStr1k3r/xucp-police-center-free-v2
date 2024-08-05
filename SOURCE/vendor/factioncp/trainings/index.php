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

echo "
                        <div class='row align-items-center'>
                            <div class='col-md-6'>
                                <div class='mb-3'>
                                </div>
                            </div>
                            <div class='col-md-6'>
                                <div class='d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3'>
                                    <div>
                                        <a href='/vendor/factioncp/trainings/index-add.php' class='text-primary bg-soft-primary p-2 mb-0 font-11 rounded'><i class='bx bx-plus me-1'></i> ".TRAIN_ADD."</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    <div class='row'>
							<div class='col-xl-12'>
								<div class='card'>
									<div class='card-body'>										
							<div class='table-responsive'>
								<table class='table'>
									<thead class=' text-primary'>
										<th>
											".TRAIN_ADD_TITLE."
										</th>					  
										<th>
											".TRAIN_ADD_WHEN."
										</th>				  
										<th>
											".TRAIN_ADD_VIEW."
										</th>																					
										<th>
											".TRAIN_ADD_EDIT."
										</th>																			
									</thead>
									<tbody>";
$select_stmt = $db->prepare(query: "SELECT * FROM xucp_police_trainings WHERE id LIKE ?");
$select_stmt->execute(array("%$query%"));
while($row = $select_stmt->fetch()) {
        echo "
										<tr>
											<td>
												" . $row["train_title"]. "
											</td>						
											<td>
												" . $row["train_when"]. "
											</td>
                                            <td>
                                                <a href='/vendor/factioncp/trainings/index-view.php?id=".$row['id']."' class='btn btn-primary w-100 waves-effect waves-light'>
                                                    <i class='dripicons-checkmark'></i>&nbsp;".TRAIN_ADD_VIEW."
                                                </a>
                                            </td>											
                                            <td>
                                                <a href='/vendor/factioncp/trainings/index-edit.php?id=".$row['id']."' class='btn btn-primary w-100 waves-effect waves-light'>
                                                    <i class='dripicons-checkmark'></i>&nbsp;".TRAIN_ADD_EDIT."
                                                </a>
                                            </td>											
										</tr>";
}
echo "					  
									</tbody>
								</table>			  
								</div>
							</div>
						</div>
					</div>";
xucp_pol_foot_logged();