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

xucp_pol_head_logged("fas fa-user-cog",FACTION_LOGBOOK_HEADER);
xucp_pol_navi_logged();
xucp_pol_content_logged("fas fa-user-cog",FACTION_LOGBOOK_HEADER);

echo "
                    <div class='row'>
							<div class='col-xl-12'>
								<div class='card'>
									<div class='card-body'>										
							<div class='table-responsive'>
								<table class='table'>
									<thead class=' text-primary'>
										<th>
											".FACTION_LOGBOOK_DESC."
										</th>					  																			
									</thead>
									<tbody>";
                                $id = 1;
                                $select_stmt = $db_sync_con->prepare(query: "SELECT * FROM logs_faction WHERE factionId =".$id);
                                $select_stmt->execute();
                                while($row = $select_stmt->fetch()) {
                                    echo "
										<tr>
											<td>
												" . $row["text"]. "
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