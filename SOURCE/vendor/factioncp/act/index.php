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

echo "
                        <div class='row align-items-center'>
                            <div class='col-md-6'>
                                <div class='mb-3'>
                                </div>
                            </div>
                            <div class='col-md-6'>
                                <div class='d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3'>
                                    <div>
                                        <a href='/vendor/factioncp/act/index-add.php' class='text-primary bg-soft-primary p-2 mb-0 font-11 rounded'><i class='bx bx-plus me-1'></i> ".CASES_ADD."</a>
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
											".CASES_FILE_NUMBER."
										</th>					  
										<th>
											".CASES_PERSON_NAME."
										</th>				  
								        <th>
									        ".CASES_IS_FINISHED."
								        </th>								        										
										<th>
											".CASES_FROM_CREATED."
										</th>
										<th>
											".CASES_DATE."
										</th>
										<th>
											".CASES_VIEW."
										</th>																					
										<th>
											".CASES_EDIT."
										</th>																			
									</thead>
									<tbody>";
$select_stmt = $db->prepare(query: "SELECT * FROM xucp_police_act WHERE id LIKE ?");
$select_stmt->execute(array("%$query%"));
while($row = $select_stmt->fetch()) {
        echo "
										<tr>
											<td>
												" . $row["act_file_number"]. "
											</td>						
											<td>
												" . $row["person_name"]. "
											</td>
											<td>
												" . $row["act_is_finished"]. "
											</td>											
											<td>
												" . $row["act_from_created"]. "
											</td>
											<td>
												" . $row["date_time"]. "
											</td>
                                            <td>
                                                <a href='/vendor/factioncp/act/index-view.php?id=".$row['id']."' class='btn btn-primary w-100 waves-effect waves-light'>
                                                    <i class='dripicons-checkmark'></i>&nbsp;".CASES_VIEW."
                                                </a>
                                            </td>											
                                            <td>
                                                <a href='/vendor/factioncp/act/index-edit.php?id=".$row['id']."' class='btn btn-primary w-100 waves-effect waves-light'>
                                                    <i class='dripicons-checkmark'></i>&nbsp;".CASES_EDIT."
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