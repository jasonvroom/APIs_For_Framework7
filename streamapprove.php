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

$userid = trim($_REQUEST['userid']);

$query = "SELECT a.enabled, b.id, b.name FROM userdatasources as a INNER JOIN datasource as b ON a.datasourceid = b.id Where a.enabled != 0 and userid =".$userid;
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
    $query = "SELECT id, description, 0 as enabled FROM subsource";
    $sub_results = $db -> runningQueryWithString($query);

    for($i=0; $i<count($sub_results); $i++) {
      $query = "SELECT enabled FROM userdatasources WHERE subsourceid = ".$sub_results[$i]["id"]." and userid = ".$userid." and datasourceid = ".$value["id"];
      $check_enabled = $db -> runningQueryWithString($query);

      if(count($check_enabled) > 0) {
        $sub_results[$i]["enabled"] = $check_enabled[0]["enabled"];
      }

      $query = "SELECT contents FROM streamapprove WHERE subsourceid = ".$sub_results[$i]["id"]." and userid = ".$userid." and datasourceid = ".$value["id"];
      $content_results = $db -> runningQueryWithString($query);

      if(count($content_results) > 0) {
        $sub_results[$i]["contents"] = $content_results[0]["contents"];
      }
    }

    $value["subsource"] = $sub_results;
  }   

  $included_subsource[]=$value;
}

echo json_encode($included_subsource);
?>