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
xucp_pol_secure_assistant_chief();

xucp_pol_head_logged("fas fa-user-edit",CHIEF_USERCONTROL);
xucp_pol_navi_logged();
xucp_pol_content_logged("fas fa-user-edit",CHIEF_USERCONTROL);

echo "
                    <div class='row'>
							<div class='col-xl-12'>
								<div class='card'>
									<div class='card-body'>										
							<div class='table-responsive mb-0' data-pattern='priority-columns'>
								<table id='tech-companies-1' class='table table-striped mb-0'>
									<thead>
								        <th>
									        ".CHIEF_USERCONTROL_RANK."
								        </th>									
										<th>
											".CHIEF_USERCONTROLUSERNAME."
										</th>					  										
										<th>
											".CHIEF_USERCONTROLOPTION."
										</th>																			
									</thead>
									<tbody>";
                                $select_stmt = $db->prepare(query: "SELECT * FROM `xucp_police_accounts` WHERE id LIKE ?");
                                $select_stmt->execute(array("%$query%"));
                                while($row = $select_stmt->fetch()) {
									echo "
										<tr>
											<td>
												" . $row['user_faction_rank']. "
											</td>										
											<td>
												" . $row["username"]. " (" . $row["charname"]. ")
											</td>						
                                            <td>
                                                <a href='/vendor/staffcp/users/index-change-view.php?id=".$row['id']."' class='btn btn-primary w-100 waves-effect waves-light'>
                                                    <i class='dripicons-checkmark'></i>&nbsp;".CHIEF_CHANGE_USER."
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
