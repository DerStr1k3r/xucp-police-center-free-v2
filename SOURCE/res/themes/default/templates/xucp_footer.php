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
if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {        
	header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
	setCookie("PHPSESSID", "", 0x7fffffff,  "/");
  	session_destroy();
	die( header( 'location: /vendor/webcp/404/index.php' ) );
}
/**
 * @return void
 */
function xucp_pol_foot_logged(): void
{
  secure_url();
  echo "
                    
                </div>
                <footer class='footer text-center text-sm-start'>
                    &copy; <script>
                        document.write(new Date().getFullYear())
                    </script> DerStr1k3r.com <span class='text-muted d-none d-sm-inline-block float-end'>Powered by xUCP Police Center Free V2.4</span>
                </footer>
            </div>
        </div>
        <script src='/res/themes/default/assets/js/jquery.min.js'></script>
        <script src='/res/themes/default/assets/js/bootstrap.bundle.min.js'></script>
        <script src='/res/themes/default/assets/js/metismenu.min.js'></script>
        <script src='/res/themes/default/assets/js/waves.js'></script>
        <script src='/res/themes/default/assets/js/feather.min.js'></script>
        <script src='/res/themes/default/assets/js/simplebar.min.js'></script>
        <script src='/res/themes/default/assets/js/moment.js'></script>
        <script src='/res/themes/default/plugins/daterangepicker/daterangepicker.js'></script>
        <script src='/res/themes/default/plugins/apex-charts/apexcharts.min.js'></script>
        <script src='/res/themes/default/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js'></script>
        <script src='/res/themes/default/plugins/jvectormap/jquery-jvectormap-us-aea-en.js'></script>
        <script src='/res/themes/default/assets/pages/jquery.analytics_dashboard.init.js'></script>
        <script src='/res/themes/default/assets/js/app.js'></script>
    </body>
</html>";   
}

/**
 * @return void
 */
function xucp_pol_foot_no_logged(): void
{
    secure_url();
    echo "
                                <div class='card-body bg-light-alt text-center'>
                                    &copy; <script>document.write(new Date().getFullYear())</script> DerStr1k3r.com<br />Powered by xUCP Police Center Free V2.4                                            
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src='/res/themes/default/assets/js/jquery.min.js'></script>
        <script src='/res/themes/default/assets/js/bootstrap.bundle.min.js'></script>
        <script src='/res/themes/default/assets/js/metismenu.min.js'></script>
        <script src='/res/themes/default/assets/js/waves.js'></script>
        <script src='/res/themes/default/assets/js/feather.min.js'></script>
        <script src='/res/themes/default/assets/js/simplebar.min.js'></script>
        <script src='/res/themes/default/assets/js/moment.js'></script>
        <script src='/res/themes/default/plugins/daterangepicker/daterangepicker.js'></script>
        <script src='/res/themes/default/plugins/apex-charts/apexcharts.min.js'></script>
        <script src='/res/themes/default/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js'></script>
        <script src='/res/themes/default/plugins/jvectormap/jquery-jvectormap-us-aea-en.js'></script>
        <script src='/res/themes/default/assets/pages/jquery.analytics_dashboard.init.js'></script>
        <script src='/res/themes/default/assets/js/app.js'></script>
    </body>
</html>";
}