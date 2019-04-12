<?php
//Method for select/show data from table with dynamic condition
function select($columns, $table, $conditions = NULL) {
	if ($conditions != NULL) {
		$sql = "SELECT $columns FROM $table WHERE $conditions ";
	} else {
		$sql = "SELECT $columns FROM $table";
	}

	//Return result
	return query($sql);
}

//To fetch the query
function result($query) {
	return mysqli_fetch_object($query);
}

//Make query
function query($sql){
	global $link;
	if ($data = mysqli_query($link, $sql)){
		return $data;

	} else {
		die(mysqli_error($link));
	}
}

//Method for executing the query
//Use when insert to databse, update, etc
function execute($sql){
	global $link;
	if (mysqli_query($link, $sql) or die(mysqli_error($link))) {
		return TRUE;
	} else {
		return FALSE;
	}
}

//Method for insert data to tables
function insert($table, $cols, $values){
	$sql = "INSERT INTO $table ($cols) VALUES ($values) ";
	//die($sql);
	return execute($sql);
}

//Method for update data to tables
function update($table, $data, $id){
	$sql = "UPDATE $table SET $data WHERE id = $id ";
	return execute($sql);
}

//Method for delete data in tables
function delete($table, $id){
	$sql = "DELETE FROM $table WHERE id = $id ";
	return execute($sql);
}

//Method to get last insert id
function getLastID() {
	global $link;
	return mysqli_insert_id($link);
}

//Method to check the data in tables
function cekRow($sql) {
	return mysqli_num_rows($sql);
}
?>