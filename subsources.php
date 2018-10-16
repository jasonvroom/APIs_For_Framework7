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

$table_name = "subsource";
$results = array();

$where[0]["field"] = "datasourceid";
$where[0]["value"] = $id;
$results = $db -> selectTable($table_name, $where);

echo json_encode($results);
?>