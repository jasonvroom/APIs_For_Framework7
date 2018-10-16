<?php
class DatabaseFuntion
{
    public function do_login($table_name,$fieldname, $fieldvalue)
	{	
		$query = "select * from ".$table_name." where ".$fieldname." = '".$fieldvalue."'";
		$result = mysql_query($query);
		if(!$result)
			echo mysql_error();
			
		$check = array();
		while($row = mysql_fetch_array($result,MYSQL_ASSOC))
  		{
			$check[] = $row;
		}
		return $check;
	}
	
	public function selectTable($table_name, $where="", $sortname="", $sorttype="", $operator="")	
	{	
		if($operator == ""){
			$operator = "=";
		}
		$query1 = "";
		if($where != ""){
			for($i=0;$i<count($where);$i++){
				$query1 = $query1." and ".$where[$i]["field"]." ".$operator." '".$where[$i]["value"]."'";			
			}
		}
		
		$query2 = "";
		if($sortname != ""){
			for($i=0;$i<count($sortname);$i++){
				if($i == 0){
					$query2 = " ORDER BY ".$sortname[$i];
				}
				else{
					$query2 = $query2.", ".$sortname[$i];
				}
				
			}
		}
		
		$query = "select * from ".$table_name." where 1 ".$query1.$query2." ".$sorttype;		
		
		//echo $query;
		
		$result = mysql_query($query);
		if(!$result)
			echo mysql_error();
			
		$check = array();
		while($row = mysql_fetch_array($result,MYSQL_ASSOC))
  		{
			$check[] = $row;
		}
		return $check;
	}

  public function insertTable($table_name, $insertvalue="")	
	{
		$query1 = "";
		$query2 = "";
		if($insertvalue != ""){
			$i=0;
			foreach($insertvalue as $key => $item) {
				if($i == 0) {
					$query1 = $key;
					$query2 = "'".$item."'";
				}
				else{
					$query1 = $query1 . ", ".$key;
					$query2 = $query2 . ", '".$item."'";
				}
				$i++;				
			}
		}
		
		$query = "INSERT INTO ".$table_name." (".$query1.") VALUES (".$query2.")";
		mysql_query($query);
	}
	
	public function updateTable($table_name, $set="", $where=""){
		$query1 = "";
		if($set != ""){
			$i=0;
			foreach($set as $key => $item) {
				if($i == 0) {
					$query1 = $key." = '".$item."'";
				}
				else{
					$query1 = $query1.", ".$key." = '".$item."'";	
				}
				$i++;
			}
		}
		
		$query2 = "1";
    if($where != ""){
      for($i=0;$i<count($where);$i++){
        $query2 = $query2." and ".$where[$i]["field"]." = '".$where[$i]["value"]."'";     
      }
    }
		
		$query = "UPDATE ".$table_name." SET ".$query1." WHERE ".$query2;
		mysql_query($query);		
	}
	
	public function deleteTable($table_name, $where="")	{
		if($where != ""){
			$query = "DELETE FROM ".$table_name." WHERE ".$where["field"]." = '".$where["value"]."'";
			mysql_query($query);
		}
	}
	
	public function runningQueryWithString($query){

		//echo $query;

		$result = mysql_query($query);
		if(!$result)
			echo mysql_error();
			
		$check = array();
		while($row = mysql_fetch_array($result,MYSQL_ASSOC))
  		{
			$check[] = $row;
		}
		return $check;
	}
    public function runningQuery($query){

        //echo $query;
        mysql_query($query);

    }
}
?>