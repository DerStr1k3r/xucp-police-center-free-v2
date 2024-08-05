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

xucp_pol_head_logged("far fa-lightbulb",WANTED_HEADER);
xucp_pol_navi_logged();
xucp_pol_content_logged("far fa-lightbulb",WANTED_HEADER);

echo "
                        <div class='row align-items-center'>
                            <div class='col-md-6'>
                                <div class='mb-3'>
                                </div>
                            </div>
                            <div class='col-md-6'>
                                <div class='d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3'>
                                    <div>
                                        <a href='/vendor/factioncp/wanted/index-add.php' class='text-primary bg-soft-primary p-2 mb-0 font-11 rounded'><i class='bx bx-plus me-1'></i> ".WANTED_ADD."</a>
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
											".WANTED_FILE_NUMBER."
										</th>					  
										<th>
											".WANTED_PERSON."
										</th>				  
								        <th>
									        ".WANTED_IS_WANTED."
								        </th>								        										
										<th>
											".WANTED_FROM_CREATED."
										</th>
										<th>
											".WANTED_DATE."
										</th>
										<th>
											".WANTED_VIEW."
										</th>																					
										<th>
											".WANTED_EDIT."
										</th>																			
									</thead>
									<tbody>";
$select_stmt = $db->prepare(query: "SELECT * FROM xucp_police_wanted WHERE id LIKE ?");
$select_stmt->execute(array("%$query%"));
while($row = $select_stmt->fetch()) {
    if($row['is_wanted'] == 'yes') {
        echo "
										<tr>
											<td>
												" . $row["file_number"]. "
											</td>						
											<td>
												" . $row["person"]. "
											</td>
											<td>
												" . $row["is_wanted"]. "
											</td>											
											<td>
												" . $row["from_created"]. "
											</td>
											<td>
												" . $row["date_time"]. "
											</td>
                                            <td>
                                                <a href='/vendor/factioncp/wanted/index-view.php?id=".$row['id']."' class='btn btn-primary w-100 waves-effect waves-light'>
                                                    <i class='dripicons-checkmark'></i>&nbsp;".WANTED_VIEW."
                                                </a>
                                            </td>											
                                            <td>
                                                <a href='/vendor/factioncp/wanted/index-edit.php?id=".$row['id']."' class='btn btn-primary w-100 waves-effect waves-light'>
                                                    <i class='dripicons-checkmark'></i>&nbsp;".WANTED_EDIT."
                                                </a>
                                            </td>											
										</tr>";
    }
}
echo "					  
									</tbody>
								</table>			  
								</div>
							</div>
						</div>
					</div>";
xucp_pol_foot_logged();