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
require_once(dirname(__FILE__) . "/config/config_mysql.php");
require_once(dirname(__FILE__) . "/config/config_settings.php");
require_once(dirname(__FILE__) . "/config/config_class.php");
require_once(dirname(__FILE__) . "/config/config_discord.php");
// ************************************************************************************//
// Themes System
// ************************************************************************************//
include(dirname(__FILE__) . "/../res/themes/default/templates/xucp_header.php");
include(dirname(__FILE__) . "/../res/themes/default/templates/xucp_leftnavi.php");
include(dirname(__FILE__) . "/../res/themes/default/templates/xucp_content.php");
include(dirname(__FILE__) . "/../res/themes/default/templates/xucp_footer.php");
include(dirname(__FILE__) . "/../res/themes/default/templates/xucp_secure.php");
// ************************************************************************************//
// Functions files from this xucp
// ************************************************************************************//
require_once(dirname(__FILE__) . "/app/xucp_session.php");
require_once(dirname(__FILE__) . "/app/xucp_lang.php");
require_once(dirname(__FILE__) . "/app/xucp_avatar.php");
require_once(dirname(__FILE__) . "/app/xucp_hash.php");
require_once(dirname(__FILE__) . "/app/xucp_urls.php");
require_once(dirname(__FILE__) . "/app/xucp_dbsync.php");
// ************************************************************************************//
// Class files from this xucp
// ************************************************************************************//
require_once(dirname(__FILE__) . "/class/xucp_class_discord.php");
// ************************************************************************************//
// Logout System
// ************************************************************************************//
if(isset($_POST['logout'])){
  xucp_pol_head_no_logged("",LOGOUT);
  xucp_pol_content_no_logged("",LOGOUT);
  echo "
                    <div class='row'>
                        <div class='col-xl-12'>
                            <div class='card'>
                                <div class='card-body text-center'>
									".MSG_17."
                                </div>
                            </div>
                        </div>
                    </div>";
  xucp_pol_foot_no_logged();
  setCookie("PHPSESSID", "", 0x7fffffff,  "/");
  session_destroy();
  session_write_close();
  exit();  
}
// ************************************************************************************//
// Get Class Name System
// ************************************************************************************//
function xucp_get_class_name($char_class): void
{
    echo match ($char_class) {
        UC_CLASS_REKRUT => TLIST_POLICE_RANK_1,
        UC_CLASS_OFFICER_1 => TLIST_POLICE_RANK_2,
        UC_CLASS_OFFICER_2 => TLIST_POLICE_RANK_3,
        UC_CLASS_SENIOR_OFFICER => TLIST_POLICE_RANK_4,
        UC_CLASS_SERGEANT_1 => TLIST_POLICE_RANK_5,
        UC_CLASS_SERGEANT_2 => TLIST_POLICE_RANK_6,
        UC_CLASS_LIEUTENENNT => TLIST_POLICE_RANK_7,
        UC_CLASS_CAPTAIN => TLIST_POLICE_RANK_8,
        UC_CLASS_COMMANDER => TLIST_POLICE_RANK_9,
        UC_CLASS_DEPUTY_CHIEF => TLIST_POLICE_RANK_10,
        UC_CLASS_ASSISTANT_CHIEF => TLIST_POLICE_RANK_11,
        UC_CLASS_CHIEF_OF_POLICE => TLIST_POLICE_RANK_12,
        UC_CLASS_WEBMASTER => TLIST_WEBMASTER,
        default => TLIST_POLICE_RANK_0,
    };
}
// ************************************************************************************//
// xUCP Police Center Free V2 Setup Check System
// ************************************************************************************//
// ************************************************************************************//
// Setup Check System
// ************************************************************************************//
function xucp_setup_check(): void
{
    if (version_compare(PHP_VERSION, '8.2.7') < 0) {
        xucp_pol_head_no_logged("detail","xUCP Police Center Free V2 Setup");
        xucp_pol_content_no_logged("detail","xUCP Police Center Free V2 Setup");
        echo '
                <div class="row row-cols-1 row-cols-lg-6 row-cols-xl-12 justify-content-center">
                    <div class="col-xl-12 text-center">
                        <div class="card">
                            <div class="card-body">
                                <p><h5>Debian 10 - 12</h5>
                                <br />
                                apt-get install nano curl unzip ca-certificates apt-transport-https lsb-release gnupg apache2 -y && wget -q https://packages.sury.org/php/apt.gpg -O- | apt-key add - && echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" | tee /etc/apt/sources.list.d/php.list
                                <br /><br />
                                apt-get update && apt-get install php8.2 php8.2-cli php8.2-common php8.2-curl php8.2-gd php8.2-intl php8.2-mbstring php8.2-mysql php8.2-opcache php8.2-readline php8.2-xml php8.2-xsl php8.2-zip php8.2-bz2 libapache2-mod-php8.2 -y
                                <br /><br />
                                apt install mariadb-server mariadb-client -y && mysql_secure_installation
                                <br /><br />
                                cd /usr/share && wget https://www.phpmyadmin.net/downloads/phpMyAdmin-latest-all-languages.zip -O phpmyadmin.zip && unzip phpmyadmin.zip && rm phpmyadmin.zip && mv phpMyAdmin-*-all-languages phpmyadmin && chmod -R 0755 phpmyadmin
                                <br /><br />
                                a2enconf phpmyadmin && systemctl reload apache2 && mkdir /usr/share/phpmyadmin/tmp/ && chown -R www-data:www-data /usr/share/phpmyadmin/tmp/
                                <br /><br />
                                a2ensite your_domain.conf
                                <br /><br />
                                a2enmod rewrite && a2enmod actions && a2enmod headers
                                <br /><br />
                                systemctl reload apache2 && systemctl restart apache2
                                <br /><br />
                                apt install certbot python3-certbot-apache && certbot --apache -d ucp.DerStr1k3r.com</p>
                            </div>
                        </div>
                    </div>
                </div>';
        xucp_pol_foot_no_logged();
    }
    else
    {
        header( 'location: /vendor/webcp/home/index.php' );
    }
}
// ************************************************************************************//
// BB-Code-Editor System
// ************************************************************************************//
function xucp_pol_text_bbcode($text, $content = ""): void
{
    $button = "/res/themes/default/assets/editor/";

    echo "
            <div class='col-lg-12'>
                <script type='text/javascript' src='/res/themes/default/assets/js/editor.js'></script>
                <script type='text/javascript'>edToolbar('" . $text . "','" . $button . "','true');</script>
                <textarea name='" . $text . "' id='" . $text . "' class='form-control' rows='16' cols='80'>" . $content . "</textarea>
            </div>";
}
// ************************************************************************************//
// Format Comment System for BB-Code-Editor System
// ************************************************************************************//
function xucp_format_comments($text, $strip_html = true): array|string
{
    $s = stripslashes($text);

    if ($strip_html)
        $s = htmlspecialchars($s);
    // [center]Centered text[/center]
    $s = preg_replace("/\[center]((\s|.)+?)\[\/center]/i", "<div class=\"text-center\">\\1</div>", $s);
    // [list]List[/list]
    $s = preg_replace("/\[list]((\s|.)+?)\[\/list]/", "<ul>\\1</ul>", $s);
    // [list=disc|circle|square]List[/list]
    $s = preg_replace("/\[list=(disc|circle|square)]((\s|.)+?)\[\/list]/", "<ul type=\"\\1\">\\2</ul>", $s);
    // [list=1|a|A|i|I]List[/list]
    $s = preg_replace("/\[list=(1|a|A|i|I)]((\s|.)+?)\[\/list]/", "<ol type=\"\\1\">\\2</ol>", $s);
    // [*]
    $s = preg_replace("/\[\*]/", "<li>", $s);
    // [b]Bold[/b]
    $s = preg_replace("/\[b]((\s|.)+?)\[\/b]/", "<b>\\1</b>", $s);
    // [i]Italic[/i]
    $s = preg_replace("/\[i]((\s|.)+?)\[\/i]/", "<i>\\1</i>", $s);
    // [u]Underline[/u]
    $s = preg_replace("/\[u]((\s|.)+?)\[\/u]/", "<u>\\1</u>", $s);
    // [u]Underline[/u]
    $s = preg_replace("/\[u]((\s|.)+?)\[\/u]/i", "<u>\\1</u>", $s);
    // [color=blue]Text[/color]
    $s = preg_replace("/\[color=([a-zA-Z]+)]((\s|.)+?)\[\/color]/i",
        "<font-color=\\1>\\2</font>", $s);
    // [img]http://www/image.gif[/img]
    $s = preg_replace("/\[img]([^\s'\"<>]+?)\[\/img]/i", "<img src=\"\\1\" alt=\"\">", $s);
    // [img=http://www/image.gif]
    $s = preg_replace("/\[img=([^\s'\"<>]+?)]/i", "<img src=\"\\1\" alt=\"\">", $s);
    // [color=#ffcc99]Text[/color]
    $s = preg_replace("/\[color=(#[a-f0-9][a-f0-9][a-f0-9][a-f0-9][a-f0-9][a-f0-9])]((\s|.)+?)\[\/color]/i",
        "<font-color=\\1>\\2</font>", $s);
    // [url=http://www.example.com]Text[/url]
    $s = preg_replace("/\[url=([^()<>\s]+?)]((\s|.)+?)\[\/url]/i",
        "<a href=\"\\1\">\\2</a>", $s);
    // [url]http://www.example.com[/url]
    $s = preg_replace("/\[url]([^()<>\s]+?)\[\/url]/i",
        "<a href=\"\\1\">\\1</a>", $s);
    // [size=4]Text[/size]
    $s = preg_replace("/\[size=([1-7])]((\s|.)+?)\[\/size]/i",
        "<font-size=\\1>\\2</font>", $s);
    // [font=Arial]Text[/font]
    $s = preg_replace("/\[font=([a-zA-Z ,]+)]((\s|.)+?)\[\/font]/i",
        "<font-face=\"\\1\">\\2</font>", $s);
    // [quote]Text[/quote]
    $s = preg_replace("/\[quote](.+?)\[\/quote]/is",
        "<div class=\"col-lg-4\"><div class=\"card\"><div class=\"card-header\">".BBCODE_EDITOR."</div><div class=\"card-body\"><div class=\"container py-5 h-100\"><blockquote class=\"card-blockquote mb-0\">\\1</blockquote></div></div></div></div>", $s);
    // [quote=Author]Text[/quote]
    $s = preg_replace("/\[quote=(.+?)](.+?)\[\/quote]/is",
        "<div class=\"col-lg-4\"><div class=\"card\"><div class=\"card-header\">\\".BBCODE_EDITOR_INFO."</div><div class=\"card-body\"><div class=\"container py-5 h-100\"><blockquote class=\"card-blockquote mb-0\">\\2</blockquote></div></div></div></div>", $s);
    // Linebreaks
    $s = nl2br($s);
    // [pre]Preformatted[/pre]
    $s = preg_replace("/\[pre]((\s|.)+?)\[\/pre]/i", "<nobr>\\1</nobr>", $s);
    // Maintain spacing
    return str_replace("  ", " &nbsp;", $s);
}