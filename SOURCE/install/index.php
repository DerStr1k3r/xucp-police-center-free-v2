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
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>xUCP Police Center Free V2.3 Installer</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<link rel="stylesheet" href="assets/css/install.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
	<link rel="shortcut icon" href="/res/themes/default/assets/images/logo-sm.png" type="image/x-icon">
</head>
<body>
	<header class="bg-xucp py-2 text-center">
		<div class="container">
			<h3 class="title">xUCP Police Center Free V2.4 Installer</h3>
		</div>
	</header>
	<div class="installation-section padding-bottom padding-top">
		<div class="container">
			<?php
			error_reporting(0);
			function isExtensionAvailable($name): bool
            {
				if (!extension_loaded($name)) {
					$response = false;
				} else {
					$response = true;
				}
				return $response;
			}
			function checkFolderPerm($name): bool
            {
				$perm = substr(sprintf('%o', fileperms($name)), -4);
				if ($perm >= '0775') {
					$response = true;
				} else {
					$response = false;
				}
				return $response;
			}
			function tableRow($name, $details, $status): void
            {
				if ($status=='1') {
					$pr = '<i class="fas fa-check"></i>';
				}else{
					$pr = '<i class="fas fa-times"></i>';
				}
				echo "<tr><td>$name</td><td>$details</td><td>$pr</td></tr>";
			}
			function getWebURL(): string
            {
				$base_url = (isset($_SERVER['HTTPS']) &&
					$_SERVER['HTTPS']!='off') ? 'https://' : 'http://';
				$tmpURL = dirname(__FILE__);
				$tmpURL = str_replace(chr(92),'/',$tmpURL);
				$tmpURL = str_replace($_SERVER['DOCUMENT_ROOT'],'',$tmpURL);
				$tmpURL = ltrim($tmpURL,'/');
				$tmpURL = rtrim($tmpURL, '/');
				$tmpURL = str_replace('install','',$tmpURL);
				$base_url .= $_SERVER['HTTP_HOST'].'/'.$tmpURL;
				if (substr("$base_url", -1=="/")) {
					$base_url = substr("$base_url", 0, -1);
				}
				return $base_url; 
			}

			function getStatus($arr): true
            {
				return true;
			}

            function setDataValue($val,$loc): void
            {
				$file = fopen($loc, 'w');
				fwrite($file, $val);
				fclose($file);
			}
			function sysInstall($sr,$pt): true
            {
				return true;
			}
			function importDatabase($pt): true
            {
					return true;

			}
			function setAdminEmail($pt): true
            {
					return true;
			}
			//------------->> Extension & Permission
			$requiredServerExtensions = [
				'BCMath', 'Ctype', 'Fileinfo', 'JSON', 'Mbstring', 'OpenSSL', 'PDO','pdo_mysql', 'Tokenizer', 'XML', 'cURL',  'GD'
			];

			$folderPermissions = [
			 '../app/','../app/config/'
			];
			//------------->> Extension & Permission

            $action = $_GET['action'] ?? "";

			if ($action=='complete') {
				?>
				<div class="installation-wrapper pt-md-5">
					<ul class="installation-menu">
						<li class="steps done">
							<div class="thumb">
								<i class="fas fa-server"></i>
							</div>
							<h5 class="content">Server<br>Requirements</h5>
						</li>
						<li class="steps done">
							<div class="thumb">
								<i class="fas fa-file-signature"></i>
							</div>
							<h5 class="content">File<br>Permissions</h5>
						</li>
						<li class="steps done">
							<div class="thumb">
								<i class="fas fa-database"></i>
							</div>
							<h5 class="content">Installation<br>Information</h5>
						</li>
						<li class="steps running">
							<div class="thumb">
								<i class="fas fa-check-circle"></i>
							</div>
							<h5 class="content">Complete<br>Installation</h5>
						</li>
					</ul>
				</div>
				<div class="installation-wrapper">
					<div class="install-content-area">
						<div class="install-item">
							<h3 class="bg-success title text-center">Complete Installation</h3>
							<div class="box-item">
								<div class="success-area text-center">
									<?php
									if ($_POST) {
										$alldata = $_POST;
										$xucp_setup_db_name = $_POST['db_name'];
										$xucp_setup_db_host = $_POST['db_host'];
										$xucp_setup_db_user = $_POST['db_user'];
										$xucp_setup_db_pass = $_POST['db_pass'];
                                        $envcontent = "
                                            $db_host=$xucp_setup_db_host
                                            $db_port=3306
                                            DB_DATABASE=$xucp_setup_db_name
                                            DB_USERNAME=$xucp_setup_db_user
                                            DB_PASSWORD=$xucp_setup_db_pass";
										$status = 'ok';
										$envpath = dirname(__DIR__, 1) . '/install/config/config_mysql.php';
										file_put_contents($envpath, $envcontent);
										if ($status == 'ok') {
											if(importDatabase($alldata)){							

                                                $conn = new PDO("mysql:host=$xucp_setup_db_host;dbname=$xucp_setup_db_name", $xucp_setup_db_user, $xucp_setup_db_pass);
                                                $query = file_get_contents("database.sql");
                                                $stmt = $conn->prepare($query);
                                                $stmt->execute();
	                                        }
                                            define('SQL_DB_DATA', '$db_host=&quot'.$xucp_setup_db_host.'&quot&bsemi;<br />$db_port=&quot3306&quot&bsemi;<br />$db_user=&quot'.$xucp_setup_db_user.'&quot&bsemi;<br />$db_password=&quot'.$xucp_setup_db_pass.'&quot&bsemi;<br />$db_name=&quot'.$xucp_setup_db_name.'&quot&bsemi;');
                                            if(setAdminEmail($alldata)){
                                                echo '<p class="text-success warning">Your database has been installed!<br />Now you have to edit your config_mysql.php file!<br /><blockquote class="card-blockquote mb-0">'.SQL_DB_DATA.'</blockquote><br />You can find a description of this in our Discord Server!<br /><br />Register now in xUCP Pro V4.5!<br />Now set your admin rank under xucp_accounts, then enter 120 in your account at adminlevel!</p>';
                                                echo '<div class="warning">
													<p class="text-danger lead my-3">Please delete the "install" folder from the server.</p>
													</div>';
                                                echo '
													<div class="warning">
													<a href="'.getWebURL().'" class="theme-button choto">Go to website</a>
													</div>';


                                            }
									    }
                                    }
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php
			}elseif($action=='info') {
				?>
				<div class="installation-wrapper pt-md-5">
					<ul class="installation-menu">
						<li class="steps done">
							<div class="thumb">
								<i class="fas fa-server"></i>
							</div>
							<h5 class="content">Server<br>Requirements</h5>
						</li>
						<li class="steps done">
							<div class="thumb">
								<i class="fas fa-file-signature"></i>
							</div>
							<h5 class="content">File<br>Permissions</h5>
						</li>
						<li class="steps running">
							<div class="thumb">
								<i class="fas fa-database"></i>
							</div>
							<h5 class="content">Installation<br>Information</h5>
						</li>
						<li class="steps">
							<div class="thumb">
								<i class="fas fa-check-circle"></i>
							</div>
							<h5 class="content">Complete<br>Installation</h5>
						</li>
					</ul>
				</div>
				<div class="installation-wrapper">
					<div class="install-content-area">
						<div class="install-item">
							<h3 class="bg-xucp title text-center">Installation Information</h3>
							<div class="box-item">
								<form action="?action=complete" method="post" class="information-form-area mb--20">
									<div class="info-item">
										<h5 class="font-weight-normal mb-2">Database Details</h5>
										<div class="row">
											<div class="information-form-group col-sm-6">
												<input type="text" name="db_name" placeholder="Database Name" required>
											</div>
											<div class="information-form-group col-sm-6">
												<input type="text" name="db_host" placeholder="Database Host" required>
											</div>
											<div class="information-form-group col-sm-6">
												<input type="text" name="db_user" placeholder="Database User" required>
											</div>
											<div class="information-form-group col-sm-6">
												<input type="text" name="db_pass" placeholder="Database Password">
											</div>
										</div>
									</div>
									<div class="info-item">
										<div class="information-form-group text-right">
											<button type="submit" class="theme-button choto">Install Now</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<?php
			}elseif ($action=='file') {
				?>
				<div class="installation-wrapper pt-md-5">
					<ul class="installation-menu">
						<li class="steps done">
							<div class="thumb">
								<i class="fas fa-server"></i>
							</div>
							<h5 class="content">Server<br>Requirements</h5>
						</li>
						<li class="steps running">
							<div class="thumb">
								<i class="fas fa-file-signature"></i>
							</div>
							<h5 class="content">File<br>Permissions</h5>
						</li>
						<li class="steps">
							<div class="thumb">
								<i class="fas fa-database"></i>
							</div>
							<h5 class="content">Installation<br>Information</h5>
						</li>
						<li class="steps">
							<div class="thumb">
								<i class="fas fa-check-circle"></i>
							</div>
							<h5 class="content">Complete<br>Installation</h5>
						</li>
					</ul>
				</div>
				<div class="installation-wrapper">
					<div class="install-content-area">
						<div class="install-item">
							<h3 class="bg-xucp title text-center">File Permissions</h3>
							<div class="box-item">
								<div class="item table-area">
									<table class="requirment-table">
										<?php
										$error = 0;
										foreach ($folderPermissions as $key) {
											$folder_perm = checkFolderPerm($key);
											if ($folder_perm) {
												tableRow(str_replace("../", "", $key)," Required Permission: 0775 ",1);
											}else{
												$error += 1;
												tableRow(str_replace("../", "", $key)," Required permission: 0775 ",0);
											}
										}
										$database = file_exists('database.sql');
										if ($database) {
											$error = $error+0;
											tableRow('Database',' Required "database.sql" available',1);
										}else{
											$error = $error+1;
											tableRow('Database',' Required "database.sql" available',0);
										}
										$database = file_exists('../.htaccess');
										if ($database) {
											$error = $error+0;
											tableRow('.htaccess','  Required ".htaccess" available',1);
										}else{
											$error = $error+1;
											tableRow('.htaccess',' Required ".htaccess" available',0);
										}
										?>
									</table>
								</div>
								<div class="item text-right">
									<?php
									if ($error==0) {
										echo '<a class="theme-button choto" href="?action=info">Next Step <i class="fa fa-angle-double-right"></i></a>';
									}else{
										echo '<a class="theme-button btn-warning choto" href="?action=file">ReCheck <i class="fa fa-sync-alt"></i></a>';
									}
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php
			}elseif ($action=='server') {
				?>
				<div class="installation-wrapper pt-md-5">
					<ul class="installation-menu">
						<li class="steps running">
							<div class="thumb">
								<i class="fas fa-server"></i>
							</div>
							<h5 class="content">Server<br>Requirements</h5>
						</li>
						<li class="steps">
							<div class="thumb">
								<i class="fas fa-file-signature"></i>
							</div>
							<h5 class="content">File<br>Permissions</h5>
						</li>
						<li class="steps">
							<div class="thumb">
								<i class="fas fa-database"></i>
							</div>
							<h5 class="content">Installation<br>Information</h5>
						</li>
						<li class="steps">
							<div class="thumb">
								<i class="fas fa-check-circle"></i>
							</div>
							<h5 class="content">Complete<br>Installation</h5>
						</li>
					</ul>
				</div>
				<div class="installation-wrapper">
					<div class="install-content-area">
						<div class="install-item">
							<h3 class="bg-xucp title text-center">Server Requirments</h3>
							<div class="box-item">
								<div class="item table-area">
									<table class="requirment-table">
										<?php
										$error = 0;
										$phpversion = version_compare(PHP_VERSION, '8.2', '>=');
										if ($phpversion) {
											$error = $error+0;
											tableRow("PHP", "Required PHP version 8.2 or higher",1);
										}else{
											$error = $error+1;
											tableRow("PHP", "Required PHP version 8.2 or higher",0);
										}
										foreach ($requiredServerExtensions as $key) {
											$extension = isExtensionAvailable($key);
											if ($extension) {
												tableRow($key, "Required ".strtoupper($key)." PHP Extension",1);
											}else{
												$error += 1;
												tableRow($key, "Required ".strtoupper($key)." PHP Extension",0);
											}
										}
										?>
									</table>
								</div>
								<div class="item text-right">
									<?php
									if ($error==0) {
										echo '<a class="theme-button choto" href="?action=file">Next Step <i class="fa fa-angle-double-right"></i></a>';
									}else{
										echo '<a class="theme-button btn-warning choto" href="?action=server">ReCheck <i class="fa fa-sync-alt"></i></a>';
									}
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php
			}else{
				?>
				<div class="installation-wrapper">
					<div class="install-content-area">
						<div class="install-item">
							<h3 class="bg-xucp title text-center">Terms of Use</h3>
							<div class="box-item">
								<div class="item">
									<h4 class="subtitle">RESALE IS PROHIBITED AND WILL BE PUNISHED BY CRIMINAL LAW!</h4>
									<p> The xUCP Police Center Free V2.4 is perfect for roleplay projects.</p>
								</div>
								<div class="item">
									<h5 class="subtitle font-weight-bold">By purchasing the xUCP Police Center Free V2.4 you agree that you will receive free updates for 3 month.</h5>
									<ul class="check-list">
										<li> You are not allowed to remove the copyright. </li>
										<li> Violation will result in a notification! </li>
										<li> A license to remove the copyright costs you a one-time fee of 49€.</li>
									</ul>
									<span class="text-warning"><i class="fas fa-exclamation-triangle"></i>  If any issue or error occurred for your modification on our code/database, we will not be responsible for that. </span>
								</div>
								<div class="item text-right">
									<a href="?action=server" class="theme-button choto">I Agree, Next Step</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php
			}
			?>
		</div>
	</div>
	<footer class="bg-xucp py-3 text-center">
		<div class="container">
			<p class="m-0 font-weight-bold">&copy;<?php echo Date('Y') ?> DerStr1k3r.com. All rights reserved.</p>
		</div>
	</footer>
	<style>
		#hide{
			display: none;
		}
	</style>
</body>
</html>