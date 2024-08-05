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

xucp_pol_head_logged("far fa-question-circle",RESIDENT_DATABASE_HEADER);
xucp_pol_navi_logged();
xucp_pol_content_logged("far fa-question-circle",RESIDENT_DATABASE_HEADER);

echo "
                    <div class='row'>
							<div class='col-xl-12'>
								<div class='card'>
									<div class='card-body'>										
							<div class='table-responsive'>
								<table class='table'>
									<thead class=' text-primary'>
										<th>
											".RESIDENT_DATABASE_NAME."
										</th>
										<th>
											".RESIDENT_DATABASE_BIRTHDATE."
										</th>
										<th>
											".RESIDENT_DATABASE_BIRTHPLACE."
										</th>
										<th>
											".RESIDENT_DATABASE_JOB."
										</th>																																			  																			
									</thead>
									<tbody>";
$select_stmt = $db_sync_con->prepare(query: "SELECT * FROM accounts_characters WHERE charId LIKE ?");
$select_stmt->execute(array("%$query%"));
while($row = $select_stmt->fetch()) {
    echo "
										<tr>
											<td>
												" . $row["charname"]. "
											</td>																	
											<td>
												" . $row["birthdate"]. "
											</td>																	
											<td>
												" . $row["birthplace"]. "
											</td>																	
											<td>
												" . $row["job"]. "
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