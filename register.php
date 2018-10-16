<?php
/**
* Created by PhpStorm.
* User: Jason
* Date: 5/14/2018
* Time: 20:47
*/

require_once('config/config.php');
require_once "config/functions.php";

$db= new DatabaseFuntion;
$table_name = "users";
$send_data = array();

$username = trim($_REQUEST['username']);
$email = trim($_REQUEST['email']);
$password = trim($_REQUEST['password']);

$where[0]["field"] = "username";
$where[0]["value"] = $username;
$check = $db -> selectTable($table_name, $where);

if(count($check) == 0) {
    //-----------------------
    //--getting salt
    //-----------------------
    $Blowfish_Pre = '$2a$05$';
    $Blowfish_End = '$';
    $Allowed_Chars =
        'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789./';
    $Chars_Len = 63;

    // 18 would be secure as well.
    $Salt_Length = 21;

    $mysql_date = date( 'Y-m-d' );
    $salt = "";

    for($i=0; $i<$Salt_Length; $i++)
    {
        $salt .= $Allowed_Chars[mt_rand(0,$Chars_Len)];
    }
    $bcrypt_salt = $Blowfish_Pre . $salt . $Blowfish_End;
    $hashed_password = crypt($password, $bcrypt_salt);

    $list['username'] = mysql_real_escape_string($username);
    $list['email'] = mysql_real_escape_string($email);
    $list['password'] = mysql_real_escape_string($hashed_password);
    $list['salt'] = mysql_real_escape_string($salt);
    $db -> insertTable($table_name, $list);

    $send_data['state'] = 'success';
    $send_data['userid'] = mysql_insert_id();
    echo json_encode($send_data);
}
else{
    $send_data['state'] = 'duplication';
    echo json_encode($send_data);
}

?>