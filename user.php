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

$table_name = "users";
$results = array();

$action = trim($_REQUEST['action']);
$userid = trim($_REQUEST['userid']);

if($action == "get") {
  $where[0]["field"] = "id";
  $where[0]["value"] = $userid;
  $results = $db -> selectTable($table_name, $where);

  echo json_encode($results[0]);
}

if($action == "update_uploading") {
  $uploading = trim($_REQUEST['uploading']);

  $where[0]["field"] = "id";
  $where[0]["value"] = $userid;
  $set["uploading"] = $uploading;

  $db -> updateTable($table_name, $set, $where);
}

if($action == "delete_user") {
  $deletWhere["field"] = 'id';
  $deletWhere["value"] = $userid;
  $db -> deleteTable($table_name, $deletWhere);

  $deletWhere["field"] = 'userid';
  $deletWhere["value"] = $userid;
  $db -> deleteTable("userdatasources", $deletWhere);

  $deletWhere["field"] = 'userid';
  $deletWhere["value"] = $userid;
  $db -> deleteTable("userbalance", $deletWhere);

  echo "success";
}
?>