<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_link1 = "localhost";
$database_link1 = "secitif_demo";
$username_link1 = "root";
$password_link1 = "";
$link1 = mysql_pconnect($hostname_link1, $username_link1, $password_link1) or trigger_error(mysql_error(),E_USER_ERROR);
mysql_set_charset('utf8',$link1);
mysql_select_db($database_link1, $link1);
?>