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

$table_name = "userdatasources";
$action = $_REQUEST['action'];

if($action == "get_userdatasources") {
  $userid = trim($_REQUEST['userid']);

  $query = "SELECT a.enabled, b.* FROM ".$table_name." as a INNER JOIN datasource as b ON a.datasourceid = b.id Where userid =".$userid;
  $results = $db -> runningQueryWithString($query);
  $results = array_unique($results, SORT_REGULAR);

  $updated_results = array();
  foreach ($results as $key=>$value) {
    for($i=0; $i<count($updated_results); $i++) {
      if($value["id"] == $updated_results[$i]["id"]) {
        $updated_results[$i]["enabled"] = max($value["enabled"], $updated_results[$i]["enabled"]);
        goto end_compare_for_source;
      }
    }

    $updated_results[]=$value;
    end_compare_for_source:
  }

  echo json_encode($updated_results);
}

if($action == "update_userdatasources") {
  $id = trim($_REQUEST['id']);
  $userid = trim($_REQUEST['userid']);
  $enabled =  trim($_REQUEST['enabled']);

  $where[0]["field"] = "datasourceid";
  $where[0]["value"] = $id;
  $where[1]["field"] = "userid";
  $where[1]["value"] = $userid;
  $results = $db -> selectTable($table_name, $where);

  if(count($results) == 0) {
    $data['userid'] = $userid;
    $data['datasourceid'] = $id;
    $data['subsourceid'] = 1;
    $data['enabled'] = 1;

    $db -> insertTable($table_name, $data);
  }
  else {
    $set["enabled"] = 0;

    $db -> updateTable($table_name, $set, $where);

    $where[2]["field"] = "subsourceid";
    $where[2]["value"] = 1;
    $set["enabled"] = $enabled;

    $db -> updateTable($table_name, $set, $where);
  }    
}

if($action == "get_usersubsources") {
  $userid = trim($_REQUEST['userid']);

  $query = "SELECT a.enabled, b.* FROM ".$table_name." as a INNER JOIN datasource as b ON a.datasourceid = b.id Where userid =".$userid;
  $results = $db -> runningQueryWithString($query);
  $results = array_unique($results, SORT_REGULAR);

  $updated_results = array();
  foreach ($results as $key=>$value) {
    for($i=0; $i<count($updated_results); $i++) {
      if($value["id"] == $updated_results[$i]["id"]) {
        $updated_results[$i]["enabled"] = max($value["enabled"], $updated_results[$i]["enabled"]);
        goto end_compare_for_sub;
      }
    }

    $updated_results[]=$value;
    end_compare_for_sub:
  }

  $included_subsource = array();
  foreach ($updated_results as $key=>$value) {
    if($value["enabled"] == 0) {
      $query = "SELECT *, 0 as enabled FROM subsource";
      $sub_results = $db -> runningQueryWithString($query);

      $value["subsource"] = $sub_results;
    }
    else {
      $query = "SELECT *, 0 as enabled FROM subsource";
      $sub_results = $db -> runningQueryWithString($query);

      for($i=0; $i<count($sub_results); $i++) {
        $query = "SELECT enabled FROM userdatasources WHERE subsourceid = ".$sub_results[$i]["id"]." and userid = ".$userid." and datasourceid = ".$value["id"];
        $r = $db -> runningQueryWithString($query);

        if(count($r) > 0) {
          $sub_results[$i]["enabled"] = $r[0]["enabled"];
        }
      }

      $value["subsource"] = $sub_results;
    }   

    $included_subsource[]=$value;
  }

  echo json_encode($included_subsource);
}

if($action == "update_usersubsources") {
  $userid = trim($_REQUEST['userid']);
  $datasourceid = trim($_REQUEST['datasourceid']);
  $subsourceid = trim($_REQUEST['subsourceid']);
  $enabled = trim($_REQUEST['enabled']);

  $where[0]["field"] = "userid";
  $where[0]["value"] = $userid;
  $where[1]["field"] = "datasourceid";
  $where[1]["value"] = $datasourceid;
  $where[2]["field"] = "subsourceid";
  $where[2]["value"] = $subsourceid;

  $results = $db -> selectTable($table_name, $where);

  if(count($results) == 0) {
    $data['userid'] = $userid;
    $data['datasourceid'] = $datasourceid;
    $data['subsourceid'] = $subsourceid;
    $data['enabled'] = $enabled;

    $db -> insertTable($table_name, $data);
  }
  else {
    $set["enabled"] = $enabled;

    $db -> updateTable($table_name, $set, $where);
  }
}

?>