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

$table_name = "commsettings";
$results = array();

$action = $_REQUEST['action'];
$userid = trim($_REQUEST['userid']);

if($action == "get") {
  $where[0]["field"] = "id";
  $where[0]["value"] = $userid;
  $results = $db -> selectTable($table_name, $where);

  echo json_encode($results);
}

if($action == "update") {
  $type = trim($_REQUEST['type']);
  $enabled = trim($_REQUEST['enabled']);

  $where[0]["field"] = "id";
  $where[0]["value"] = $userid;
  $check = $db -> selectTable($table_name, $where);

  if(count($check) == 0) {
    $data['userid'] = $userid;
    if($type == "email") {
      $data["email"] = $enabled;
    }
    else if($type == "whatsapp") {
      $data["whatsapp"] = $enabled;
    }

    $db -> insertTable($table_name, $data);
  }
  else {
    if($type == "email") {
      $set["email"] = $enabled;
    }
    else if($type == "whatsapp") {
      $set["whatsapp"] = $enabled;
    }
    
    $db -> updateTable($table_name, $set, $where);
  }

}

?>