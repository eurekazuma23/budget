<?php
//BASIC MODEL FOR HANDLING QUERIES
class myDB_MODEL extends CI_Model{
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	public function fetch($table,$type = false,$cond = false){
		if (trim($cond)!=""){
			$condition = "WHERE $cond";
		} if (trim($type)==""){
			$type = "*";
		}
		$q = $this->db->query("SELECT $type FROM $table $condition");
		return $q->result();
	}
	public function insert($table,$values){
		$q = $this->db->query("INSERT INTO $table VALUES($values)");
		return "true";
	}
	public function update($table,$fields=array(),$values = array(),$cond){
		$res = "";
		if (count ($fields)!=count($values)){
			$res = "Field Count Does not match with Values Count.";
		} else {
			$str = "";
			$x = 0;
			$f = count($fields)-1;
			while ($x<=$f){
				if ($x!=$f){
					$ext = ",";
				} else {
					$ext = "";
				}
				$str = $str.$fields[$x]."='".$values[$x]."'".$ext;
				$x++;
			}
			$condition = "WHERE ".$cond;
			$q = $this->db->query("UPDATE $table SET $str $condition");
			$res = "true";
		}
		return $res;
	}
	public function delete($table,$cond=false){
		if (trim($cond)!=""){
			$condition = "WHERE $cond";
		}
		$q = $this->db->query("DELETE FROM $table $condition");
		return "true";
	}
}