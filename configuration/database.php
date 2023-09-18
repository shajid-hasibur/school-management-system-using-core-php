<?php

class Database
{
	private $db_host = "localhost";
	private $db_user = "root";
	private $db_password = "";
	private $db_name = "phpschool";

	private $connection = false;
	private $result = array();
	private $mysqli = "";
	
	public function __construct()
	{
		if (!$this->connection) {
			$this->mysqli = new mysqli($this->db_host,$this->db_user,$this->db_password,$this->db_name);
			$this->connection = true;

			if ($this->mysqli->connect_error) {
				array_push($this->result, $this->mysqli->connect_error);
				return false;
			}
		}else{
			return true;
		}
	}
	//function for insert data into database table
	public function insert($table, $params = array())
	{
		if ($this->tableExists($table)) {
			$table_column = implode(', ', array_keys($params));
			$table_value = implode("', '", $params);

			$sql = "INSERT INTO $table ($table_column) VALUES ('$table_value')";
			if ($this->mysqli->query($sql)) {
				array_push($this->result, $this->mysqli->insert_id);
				return true;
			}else{
				array_push($this->result, $this->mysqli->error);
				return false;
			}
		}else{
			return false;
		}
	}
	//function for update data from database table
	public function update($table, $params = array(), $where = null)
	{
		if($this->tableExists($table)){
			$args = array();
			foreach ($params as $key => $value) {
				$args[] = "$key = '$value'";
			}
			$sql = "UPDATE $table SET " . implode(', ',$args);
			if ($where != null) {
				$sql .= " WHERE $where";
			}

			if ($this->mysqli->query($sql)) {
				array_push($this->result, $this->mysqli->affected_rows);
				return true;
			}else{
				array_push($this->result, $this->mysqli->error);
				return false;
			}
		}else{
			return false;
		}
	}
	//function for delete data from database table
	public function delete($table, $where = null)
	{
		if ($this->tableExists($table)) {
			$sql = "DELETE FROM $table";
			if ($where != null) {
				$sql .= " WHERE $where";
			}
			if ($this->mysqli->query($sql)) {
				array_push($this->result, $this->mysqli->affected_rows);
				return true;
			}else{
				array_push($this->result, $this->mysqli->error);
				return false;
			}
			
		}else{
			return false;
		}
	}
	// select data from database
	public function select($table, $rows="*", $join=null, $where=null, $order=null, $limit=null)
	{
		if($this->tableExists($table)){
			$sql = "SELECT $rows FROM $table";
			if($join != null){
				$sql .= " JOIN $join";
			}
			if($where != null){
				$sql .= " WHERE $where";
			}
			if($order != null){
				$sql .= " ORDER BY $order";
			}
			if($limit != null){
				$sql .= " LIMIT 0, $limit";
			}

			$query = $this->mysqli->query($sql);
			if($query){
				$this->result = $query->fetch_all(MYSQLI_ASSOC);
				return true;
			}else{
				array_push($this->result , $this->mysqli->error);
				return false;
			}
		}else{
			return false;
		}
	}

	public function sql($sql)
	{
		$query = $this->mysqli->query($sql);
		if($query){
			$this->result = $query->fetch_all(MYSQLI_ASSOC);
			return true;
		}else{
			array_push($this->result , $this->mysqli->error);
			return false;
		}
	}

	public function tableExists($table)
	{
		$sql = "SHOW TABLES FROM $this->db_name LIKE '$table'";
		$tableInDb = $this->mysqli->query($sql);

		if ($tableInDb) {
			if ($tableInDb->num_rows == 1) {
				return true;
			}else{
				array_push($this->result,$table."does not exist in this database.");
				return false;
			}
		}
	}

	public function getResult()
	{
		$value = $this->result;
		$this->result = array();
		return $value;
	}

	//close connection
	public function __destruct()
	{
		if ($this->connection) {
			if ($this->mysqli->close()) {
				$this->connection = false;
				return true;
			}
		}else{
			return false;
		}
	}
}

?>