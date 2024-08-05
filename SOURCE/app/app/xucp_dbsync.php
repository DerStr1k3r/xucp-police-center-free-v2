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
$dbsync_u_id 	= 1;
$select_stmt = $db->prepare("SELECT dbsync_hostname, dbsync_port, dbsync_dbname, dbsync_username, dbsync_password from xucp_police_dbsync WHERE id=".$dbsync_u_id);
$select_stmt->execute();
$dbsync=$select_stmt->fetch(PDO::FETCH_ASSOC);

if($select_stmt->rowCount() > 0){
    $dbsync_host=htmlentities($dbsync["dbsync_hostname"]);
    $dbsync_port=htmlentities($dbsync["dbsync_port"]);
    $dbsync_user=htmlentities($dbsync["dbsync_username"]);
    $dbsync_password=htmlentities($dbsync["dbsync_password"]);
    $dbsync_name=htmlentities($dbsync["dbsync_dbname"]);

    try
    {
        $db_sync_con=new PDO("mysql:host={$dbsync_host};dbname={$dbsync_name}",$dbsync_user,$dbsync_password);
        $db_sync_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOEXCEPTION $e)
    {
        echo $e->getMessage();
    }
}
