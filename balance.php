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

$action = $_REQUEST['action'];

if($action == "get") {
  $userid = trim($_REQUEST['userid']);
  $query = 'SELECT * FROM userbalance WHERE userid = '.$userid;
  $result =  $db -> runningQueryWithString($query);

  $graph_query = 'SELECT current, date FROM userbalance WHERE yearweek(DATE(date), 1) = yearweek(curdate(), 1)';
  $graph_query_results = $db -> runningQueryWithString($graph_query);

  $results['user_balance'] = $result[0];
  $results['graph_balances'] = $graph_query_results;

  echo json_encode($results);
}

?>