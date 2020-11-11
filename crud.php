<?php
require_once("config.php");
class CRUD{
	public function insert($table, $columns, $values){
		$sql ="insert into $table ($columns) values($values)";	
		$insert = mysqli_query($GLOBALS['DB'],  $sql) or die("not executed the insert query");
		return $insert;		
	}
	public function select($table, $columns, $conditions){
		$sql = "select $columns from $table";
		if($conditions !=""){
			$sql .="  where $conditions";
		}
		$rows = mysqli_query($GLOBALS['DB'],  $sql) or die("not executed the insert query");
		$array = [];
		while($re = mysqli_fetch_assoc($rows)){
			$array[] = $re;
		}
		return $array;
	}
	public function select_raw($sql){
		$rows = mysqli_query($GLOBALS['DB'],  $sql) or die("not executed the insert query");
		$array = [];
		while($re = mysqli_fetch_assoc($rows)){
		$array[] = $re;
		}
		return $array;
	}
	public function delete($table, $conditions){
		$sql = "delete from $table where $conditions";
		$row = mysqli_query($GLOBALS['DB'], $sql) or die(mysqli_error($GLOBALS['DB']));
		return $row;
	}
	function update($table, $data, $conditions){
		$sql = "UPDATE $table SET $data WHERE $conditions";	
		$row = mysqli_query($GLOBALS['DB'], $sql) or die(mysqli_error($GLOBALS['DB']));
		return $row;
	}
	public function select_one($table, $conditions){
		$sql = "select * from $table where $conditions";
		$rows = mysqli_query($GLOBALS['DB'],  $sql) or die("not executed the insert query");
		$row = mysqli_fetch_assoc($rows);
		return $row;
	}	
}