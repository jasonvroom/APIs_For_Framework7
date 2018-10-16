<?php
/**
* Created by Jason.
* User: Jason
* Date: 5/14/2018
* Time: 20:47
*/

require_once('config/config.php');
require_once "config/functions.php";

$db= new DatabaseFuntion;
$table_name = "users";

$username = trim($_REQUEST['username']);
$password = trim($_REQUEST['password']);

$Blowfish_Pre = '$2a$05$';
$Blowfish_End = '$';

$results = $db -> do_login($table_name,"username", $username);
$send_data = array();

if(count($results) == 0){
  $send_data['state'] = 'invalid';
  echo json_encode($send_data);
}
else{
  $object = $results[0];

  $hashed_pass = crypt($password, $Blowfish_Pre . $results[0]["salt"] . $Blowfish_End);

  if($results[0]["password"] == $hashed_pass){
    $send_data['state'] = 'valid';
    $send_data['userid'] = $results[0]["id"];
    echo json_encode($send_data);
  }
  else{
    $send_data['state'] = 'invalid';
    echo json_encode($send_data);
  }
}

?>