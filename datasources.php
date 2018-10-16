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

$table_name = "datasource";
$results = array();

if(isset($_REQUEST['id'])) {
  $id = trim($_REQUEST['id']);

  $where[0]["field"] = "id";
  $where[0]["value"] = $id;
  $results = $db -> selectTable($table_name, $where);
}
else {
  $results = $db -> selectTable($table_name);
}

echo json_encode($results);
?>