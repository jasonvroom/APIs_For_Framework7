<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

define ("DB_HOST","localhost");
define ("DB_USER","root");
define ("DB_PASS","");
define ("DB_NAME","iosApp");

define("SERVER_URL","http://localhost/f7_API");

mysql_connect (DB_HOST,DB_USER,DB_PASS) or die ("Couldn't connect with database!");
mysql_select_db(DB_NAME) or die ("Database not found!");

header('Content-Type: text/html; charset=utf-8');

?>
