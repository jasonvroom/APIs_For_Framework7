<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 16/07/15
 * Time: 20:48
 */
require_once('config/config.php');
require_once "config/functions.php";

$db= new DatabaseFuntion;

$table_name = "uploads";
$results = array();

$query = "SELECT a.*, b.name, c.description FROM ".$table_name." as a INNER JOIN datasource as b ON a.datasourceid = b.id INNER JOIN subsource as c ON a.subsourceid = c.id";
$results = $db -> runningQueryWithString($query);

echo json_encode($results);
?>