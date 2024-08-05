<?php
// ************************************************************************************//
// * xUCP Pro
// ************************************************************************************//
// * Author: DerStr1k3r
// ************************************************************************************//
// * Version: 3.3
// *
// * Copyright (c) 2023 - 2024 DerStr1k3r. All rights reserved.
// ************************************************************************************//
// * License Typ: GNU GPLv3
// ************************************************************************************//
include(dirname(__FILE__) . "/../../../app/system.php");

xucp_pol_secure();
secure_url();

xucp_pol_secure_deputy_chief();

xucp_pol_head_logged("fas fa-users",TLIST_LEFT_NAVI_HEADER);
xucp_pol_navi_logged();
xucp_pol_content_logged("fas fa-users",TLIST_LEFT_NAVI_HEADER);

echo "
                        <div class='row'>
                            <div class='col-xl-12'>
                                <div class='card'>                        
									<div class='card-header'>
										<h4 class='card-title'>".TLIST_POLICE_RANK_12."</h4>
									</div>
									<div class='card-body'>
                                        <div class='tab-content' id='pills-tabContent'>
                                            <div class='tab-pane fade active show' id='month' role='tabpanel' aria-labelledby='monthly'>
                                                <div class='row'>";
                                            $rank_12_id = 12;
                                            $select_stmt = $db->prepare(query: "SELECT * FROM xucp_police_accounts WHERE user_faction_rank = $rank_12_id");
                                            $select_stmt->execute();
                                            while($blog_status = $select_stmt->fetch()) {
                                                echo "
                                                    <div class='col-xl-3'>
                                                        <div class='card text-center'>
                                                            <div class='card-body'>                                    
                                                                <div class='mx-auto mb-4'>
                                                                    <img src='".htmlentities($blog_status['user_avatar'], ENT_QUOTES, 'UTF-8')."' alt='' class='avatar-xl rounded-circle img-thumbnail'>
                                                                </div>
                                                                <h5 class='font-size-16 mb-1'><a href='#' class='text-dark'>".htmlentities($blog_status['charname'], ENT_QUOTES, 'UTF-8')."</a></h5>
                                                                <p class='text-muted mb-2'>".xucp_format_comments(htmlentities($blog_status['user_sig'], ENT_QUOTES, 'UTF-8'))."</p>   
                                                            </div>
                                                        </div>
                                                    </div>";
                                            }
                                            echo "
                                                </div>
                                            </div> 
                                        </div>
                                    </div>                            
								</div>
							</div>
						</div>
                        <div class='row'>
                            <div class='col-xl-12'>
                                <div class='card'>                        
									<div class='card-header'>
										<h4 class='card-title'>".TLIST_POLICE_RANK_11."</h4>
									</div>
									<div class='card-body'>
                                        <div class='tab-content' id='pills-tabContent'>
                                            <div class='tab-pane fade active show' id='month' role='tabpanel' aria-labelledby='monthly'>
                                                <div class='row'>";
                                            $rank_11_id = 11;
                                            $select_stmt = $db->prepare(query: "SELECT * FROM xucp_police_accounts WHERE user_faction_rank = $rank_11_id");
                                            $select_stmt->execute();
                                            while($blog_status = $select_stmt->fetch()) {
                                                echo "
                                                    <div class='col-xl-3'>
                                                        <div class='card text-center'>
                                                            <div class='card-body'>                                    
                                                                <div class='mx-auto mb-4'>
                                                                    <img src='".htmlentities($blog_status['user_avatar'], ENT_QUOTES, 'UTF-8')."' alt='' class='avatar-xl rounded-circle img-thumbnail'>
                                                                </div>
                                                                <h5 class='font-size-16 mb-1'><a href='#' class='text-dark'>".htmlentities($blog_status['charname'], ENT_QUOTES, 'UTF-8')."</a></h5>
                                                                <p class='text-muted mb-2'>".xucp_format_comments(htmlentities($blog_status['user_sig'], ENT_QUOTES, 'UTF-8'))."</p>   
                                                            </div>
                                                        </div>
                                                    </div>";
                                            }
                                            echo "
                                                </div>
                                            </div> 
                                        </div>
                                    </div>                            
								</div>
							</div>
						</div>
                        <div class='row'>
                            <div class='col-xl-12'>
                                <div class='card'>                        
									<div class='card-header'>
										<h4 class='card-title'>".TLIST_POLICE_RANK_10."</h4>
									</div>
									<div class='card-body'>
                                        <div class='tab-content' id='pills-tabContent'>
                                            <div class='tab-pane fade active show' id='month' role='tabpanel' aria-labelledby='monthly'>
                                                <div class='row'>";
                                            $rank_10_id = 10;
                                            $select_stmt = $db->prepare(query: "SELECT * FROM xucp_police_accounts WHERE user_faction_rank = $rank_10_id");
                                            $select_stmt->execute();
                                            while($blog_status = $select_stmt->fetch()) {
                                                echo "
                                                    <div class='col-xl-3'>
                                                        <div class='card text-center'>
                                                            <div class='card-body'>                                    
                                                                <div class='mx-auto mb-4'>
                                                                    <img src='".htmlentities($blog_status['user_avatar'], ENT_QUOTES, 'UTF-8')."' alt='' class='avatar-xl rounded-circle img-thumbnail'>
                                                                </div>
                                                                <h5 class='font-size-16 mb-1'><a href='#' class='text-dark'>".htmlentities($blog_status['charname'], ENT_QUOTES, 'UTF-8')."</a></h5>
                                                                <p class='text-muted mb-2'>".xucp_format_comments(htmlentities($blog_status['user_sig'], ENT_QUOTES, 'UTF-8'))."</p>   
                                                            </div>
                                                        </div>
                                                    </div>";
                                            }
                                            echo "
                                                </div>
                                            </div> 
                                        </div>
                                    </div>                            
								</div>
							</div>
						</div>
                        <div class='row'>
                            <div class='col-xl-12'>
                                <div class='card'>                        
									<div class='card-header'>
										<h4 class='card-title'>".TLIST_POLICE_RANK_9."</h4>
									</div>
									<div class='card-body'>
                                        <div class='tab-content' id='pills-tabContent'>
                                            <div class='tab-pane fade active show' id='month' role='tabpanel' aria-labelledby='monthly'>
                                                <div class='row'>";
                                            $rank_9_id = 9;
                                            $select_stmt = $db->prepare(query: "SELECT * FROM xucp_police_accounts WHERE user_faction_rank = $rank_9_id");
                                            $select_stmt->execute();
                                            while($blog_status = $select_stmt->fetch()) {
                                                echo "
                                                    <div class='col-xl-3'>
                                                        <div class='card text-center'>
                                                            <div class='card-body'>                                    
                                                                <div class='mx-auto mb-4'>
                                                                    <img src='".htmlentities($blog_status['user_avatar'], ENT_QUOTES, 'UTF-8')."' alt='' class='avatar-xl rounded-circle img-thumbnail'>
                                                                </div>
                                                                <h5 class='font-size-16 mb-1'><a href='#' class='text-dark'>".htmlentities($blog_status['charname'], ENT_QUOTES, 'UTF-8')."</a></h5>
                                                                <p class='text-muted mb-2'>".xucp_format_comments(htmlentities($blog_status['user_sig'], ENT_QUOTES, 'UTF-8'))."</p>   
                                                            </div>
                                                        </div>
                                                    </div>";
                                            }
                                            echo "
                                                </div>
                                            </div> 
                                        </div>
                                    </div>                            
								</div>
							</div>
						</div>
                        <div class='row'>
                            <div class='col-xl-12'>
                                <div class='card'>                        
									<div class='card-header'>
										<h4 class='card-title'>".TLIST_POLICE_RANK_8."</h4>
									</div>
									<div class='card-body'>
                                        <div class='tab-content' id='pills-tabContent'>
                                            <div class='tab-pane fade active show' id='month' role='tabpanel' aria-labelledby='monthly'>
                                                <div class='row'>";
                                            $rank_8_id = 8;
                                            $select_stmt = $db->prepare(query: "SELECT * FROM xucp_police_accounts WHERE user_faction_rank = $rank_8_id");
                                            $select_stmt->execute();
                                            while($blog_status = $select_stmt->fetch()) {
                                                echo "
                                                    <div class='col-xl-3'>
                                                        <div class='card text-center'>
                                                            <div class='card-body'>                                    
                                                                <div class='mx-auto mb-4'>
                                                                    <img src='".htmlentities($blog_status['user_avatar'], ENT_QUOTES, 'UTF-8')."' alt='' class='avatar-xl rounded-circle img-thumbnail'>
                                                                </div>
                                                                <h5 class='font-size-16 mb-1'><a href='#' class='text-dark'>".htmlentities($blog_status['charname'], ENT_QUOTES, 'UTF-8')."</a></h5>
                                                                <p class='text-muted mb-2'>".xucp_format_comments(htmlentities($blog_status['user_sig'], ENT_QUOTES, 'UTF-8'))."</p>   
                                                            </div>
                                                        </div>
                                                    </div>";
                                            }
                                            echo "
                                                </div>
                                            </div> 
                                        </div>
                                    </div>                            
								</div>
							</div>
						</div>
                        <div class='row'>
                            <div class='col-xl-12'>
                                <div class='card'>                        
									<div class='card-header'>
										<h4 class='card-title'>".TLIST_POLICE_RANK_7."</h4>
									</div>
									<div class='card-body'>
                                        <div class='tab-content' id='pills-tabContent'>
                                            <div class='tab-pane fade active show' id='month' role='tabpanel' aria-labelledby='monthly'>
                                                <div class='row'>";
                                            $rank_7_id = 7;
                                            $select_stmt = $db->prepare(query: "SELECT * FROM xucp_police_accounts WHERE user_faction_rank = $rank_7_id");
                                            $select_stmt->execute();
                                            while($blog_status = $select_stmt->fetch()) {
                                                echo "
                                                    <div class='col-xl-3'>
                                                        <div class='card text-center'>
                                                            <div class='card-body'>                                    
                                                                <div class='mx-auto mb-4'>
                                                                    <img src='".htmlentities($blog_status['user_avatar'], ENT_QUOTES, 'UTF-8')."' alt='' class='avatar-xl rounded-circle img-thumbnail'>
                                                                </div>
                                                                <h5 class='font-size-16 mb-1'><a href='#' class='text-dark'>".htmlentities($blog_status['charname'], ENT_QUOTES, 'UTF-8')."</a></h5>
                                                                <p class='text-muted mb-2'>".xucp_format_comments(htmlentities($blog_status['user_sig'], ENT_QUOTES, 'UTF-8'))."</p>   
                                                            </div>
                                                        </div>
                                                    </div>";
                                            }
                                            echo "
                                                </div>
                                            </div> 
                                        </div>
                                    </div>                            
								</div>
							</div>
						</div>
                        <div class='row'>
                            <div class='col-xl-12'>
                                <div class='card'>                        
									<div class='card-header'>
										<h4 class='card-title'>".TLIST_POLICE_RANK_6."</h4>
									</div>
									<div class='card-body'>
                                        <div class='tab-content' id='pills-tabContent'>
                                            <div class='tab-pane fade active show' id='month' role='tabpanel' aria-labelledby='monthly'>
                                                <div class='row'>";
                                            $rank_6_id = 6;
                                            $select_stmt = $db->prepare(query: "SELECT * FROM xucp_police_accounts WHERE user_faction_rank = $rank_6_id");
                                            $select_stmt->execute();
                                            while($blog_status = $select_stmt->fetch()) {
                                                echo "
                                                    <div class='col-xl-3'>
                                                        <div class='card text-center'>
                                                            <div class='card-body'>                                    
                                                                <div class='mx-auto mb-4'>
                                                                    <img src='".htmlentities($blog_status['user_avatar'], ENT_QUOTES, 'UTF-8')."' alt='' class='avatar-xl rounded-circle img-thumbnail'>
                                                                </div>
                                                                <h5 class='font-size-16 mb-1'><a href='#' class='text-dark'>".htmlentities($blog_status['charname'], ENT_QUOTES, 'UTF-8')."</a></h5>
                                                                <p class='text-muted mb-2'>".xucp_format_comments(htmlentities($blog_status['user_sig'], ENT_QUOTES, 'UTF-8'))."</p>   
                                                            </div>
                                                        </div>
                                                    </div>";
                                            }
                                            echo "
                                                </div>
                                            </div> 
                                        </div>
                                    </div>                            
								</div>
							</div>
						</div>
                        <div class='row'>
                            <div class='col-xl-12'>
                                <div class='card'>                        
									<div class='card-header'>
										<h4 class='card-title'>".TLIST_POLICE_RANK_5."</h4>
									</div>
									<div class='card-body'>
                                        <div class='tab-content' id='pills-tabContent'>
                                            <div class='tab-pane fade active show' id='month' role='tabpanel' aria-labelledby='monthly'>
                                                <div class='row'>";
                                            $rank_5_id = 5;
                                            $select_stmt = $db->prepare(query: "SELECT * FROM xucp_police_accounts WHERE user_faction_rank = $rank_5_id");
                                            $select_stmt->execute();
                                            while($blog_status = $select_stmt->fetch()) {
                                                echo "
                                                    <div class='col-xl-3'>
                                                        <div class='card text-center'>
                                                            <div class='card-body'>                                    
                                                                <div class='mx-auto mb-4'>
                                                                    <img src='".htmlentities($blog_status['user_avatar'], ENT_QUOTES, 'UTF-8')."' alt='' class='avatar-xl rounded-circle img-thumbnail'>
                                                                </div>
                                                                <h5 class='font-size-16 mb-1'><a href='#' class='text-dark'>".htmlentities($blog_status['charname'], ENT_QUOTES, 'UTF-8')."</a></h5>
                                                                <p class='text-muted mb-2'>".xucp_format_comments(htmlentities($blog_status['user_sig'], ENT_QUOTES, 'UTF-8'))."</p>   
                                                            </div>
                                                        </div>
                                                    </div>";
                                            }
                                            echo "
                                                </div>
                                            </div> 
                                        </div>
                                    </div>                            
								</div>
							</div>
						</div>
                        <div class='row'>
                            <div class='col-xl-12'>
                                <div class='card'>                        
									<div class='card-header'>
										<h4 class='card-title'>".TLIST_POLICE_RANK_4."</h4>
									</div>
									<div class='card-body'>
                                        <div class='tab-content' id='pills-tabContent'>
                                            <div class='tab-pane fade active show' id='month' role='tabpanel' aria-labelledby='monthly'>
                                                <div class='row'>";
                                            $rank_4_id = 4;
                                            $select_stmt = $db->prepare(query: "SELECT * FROM xucp_police_accounts WHERE user_faction_rank = $rank_4_id");
                                            $select_stmt->execute();
                                            while($blog_status = $select_stmt->fetch()) {
                                                echo "
                                                    <div class='col-xl-3'>
                                                        <div class='card text-center'>
                                                            <div class='card-body'>                                    
                                                                <div class='mx-auto mb-4'>
                                                                    <img src='".htmlentities($blog_status['user_avatar'], ENT_QUOTES, 'UTF-8')."' alt='' class='avatar-xl rounded-circle img-thumbnail'>
                                                                </div>
                                                                <h5 class='font-size-16 mb-1'><a href='#' class='text-dark'>".htmlentities($blog_status['charname'], ENT_QUOTES, 'UTF-8')."</a></h5>
                                                                <p class='text-muted mb-2'>".xucp_format_comments(htmlentities($blog_status['user_sig'], ENT_QUOTES, 'UTF-8'))."</p>   
                                                            </div>
                                                        </div>
                                                    </div>";
                                            }
                                            echo "
                                                </div>
                                            </div> 
                                        </div>
                                    </div>                            
								</div>
							</div>
						</div>
                        <div class='row'>
                            <div class='col-xl-12'>
                                <div class='card'>                        
									<div class='card-header'>
										<h4 class='card-title'>".TLIST_POLICE_RANK_3."</h4>
									</div>
									<div class='card-body'>
                                        <div class='tab-content' id='pills-tabContent'>
                                            <div class='tab-pane fade active show' id='month' role='tabpanel' aria-labelledby='monthly'>
                                                <div class='row'>";
                                            $rank_3_id = 3;
                                            $select_stmt = $db->prepare(query: "SELECT * FROM xucp_police_accounts WHERE user_faction_rank = $rank_3_id");
                                            $select_stmt->execute();
                                            while($blog_status = $select_stmt->fetch()) {
                                                echo "
                                                    <div class='col-xl-3'>
                                                        <div class='card text-center'>
                                                            <div class='card-body'>                                    
                                                                <div class='mx-auto mb-4'>
                                                                    <img src='".htmlentities($blog_status['user_avatar'], ENT_QUOTES, 'UTF-8')."' alt='' class='avatar-xl rounded-circle img-thumbnail'>
                                                                </div>
                                                                <h5 class='font-size-16 mb-1'><a href='#' class='text-dark'>".htmlentities($blog_status['charname'], ENT_QUOTES, 'UTF-8')."</a></h5>
                                                                <p class='text-muted mb-2'>".xucp_format_comments(htmlentities($blog_status['user_sig'], ENT_QUOTES, 'UTF-8'))."</p>   
                                                            </div>
                                                        </div>
                                                    </div>";
                                            }
                                            echo "
                                                </div>
                                            </div> 
                                        </div>
                                    </div>                            
								</div>
							</div>
						</div>
                        <div class='row'>
                            <div class='col-xl-12'>
                                <div class='card'>                        
									<div class='card-header'>
										<h4 class='card-title'>".TLIST_POLICE_RANK_2."</h4>
									</div>
									<div class='card-body'>
                                        <div class='tab-content' id='pills-tabContent'>
                                            <div class='tab-pane fade active show' id='month' role='tabpanel' aria-labelledby='monthly'>
                                                <div class='row'>";
                                            $rank_2_id = 2;
                                            $select_stmt = $db->prepare(query: "SELECT * FROM xucp_police_accounts WHERE user_faction_rank = $rank_2_id");
                                            $select_stmt->execute();
                                            while($blog_status = $select_stmt->fetch()) {
                                                echo "
                                                    <div class='col-xl-3'>
                                                        <div class='card text-center'>
                                                            <div class='card-body'>                                    
                                                                <div class='mx-auto mb-4'>
                                                                    <img src='".htmlentities($blog_status['user_avatar'], ENT_QUOTES, 'UTF-8')."' alt='' class='avatar-xl rounded-circle img-thumbnail'>
                                                                </div>
                                                                <h5 class='font-size-16 mb-1'><a href='#' class='text-dark'>".htmlentities($blog_status['charname'], ENT_QUOTES, 'UTF-8')."</a></h5>
                                                                <p class='text-muted mb-2'>".xucp_format_comments(htmlentities($blog_status['user_sig'], ENT_QUOTES, 'UTF-8'))."</p>   
                                                            </div>
                                                        </div>
                                                    </div>";
                                            }
                                            echo "
                                                </div>
                                            </div> 
                                        </div>
                                    </div>                            
								</div>
							</div>
						</div>
                        <div class='row'>
                            <div class='col-xl-12'>
                                <div class='card'>                        
									<div class='card-header'>
										<h4 class='card-title'>".TLIST_POLICE_RANK_1."</h4>
									</div>
									<div class='card-body'>
                                        <div class='tab-content' id='pills-tabContent'>
                                            <div class='tab-pane fade active show' id='month' role='tabpanel' aria-labelledby='monthly'>
                                                <div class='row'>";
                                            $rank_1_id = 1;
                                            $select_stmt = $db->prepare(query: "SELECT * FROM xucp_police_accounts WHERE user_faction_rank = $rank_1_id");
                                            $select_stmt->execute();
                                            while($blog_status = $select_stmt->fetch()) {
                                                echo "
                                                    <div class='col-xl-3'>
                                                        <div class='card text-center'>
                                                            <div class='card-body'>                                    
                                                                <div class='mx-auto mb-4'>
                                                                    <img src='".htmlentities($blog_status['user_avatar'], ENT_QUOTES, 'UTF-8')."' alt='' class='avatar-xl rounded-circle img-thumbnail'>
                                                                </div>
                                                                <h5 class='font-size-16 mb-1'><a href='#' class='text-dark'>".htmlentities($blog_status['charname'], ENT_QUOTES, 'UTF-8')."</a></h5>
                                                                <p class='text-muted mb-2'>".xucp_format_comments(htmlentities($blog_status['user_sig'], ENT_QUOTES, 'UTF-8'))."</p>   
                                                            </div>
                                                        </div>
                                                    </div>";
                                            }
                                            echo "
                                                </div>
                                            </div> 
                                        </div>
                                    </div>                            
								</div>
							</div>
						</div>";
xucp_pol_foot_logged();