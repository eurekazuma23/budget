<?php
class coa_model extends CI_Model{
	private $base = "http://localhost/budget/";


	public function __construct(){
		parent::__construct();
	}
	
	public function base_url(){
		return $this->base;
	}
	public function auth($username,$password){
		$this->load->database();
		$q = $this->db->query("select * from users where username='".$username."' and password='".sha1($password)."'");
		return $q;
	}


	public function ClientMapper($parent = false,$child = false){
		$mainMenu = array(
			'Home'=>$this->base.'client/',
			'Transaction'=>$this->base.'client/transaction/',
			'Query'=>$this->base.'client/query/',
			'Utilities'=>$this->base.'client/utilities/'
			);
		$m = array_keys($mainMenu);
		$subMenu = array(
			'Not Needing Clearance'=>$this->base.'client/transaction/NotneedingClearance/',
			'Needing Clearance'=>$this->base.'client/transaction/needingClearance/',
			'Special Allotment'=>$this->base.'client/transaction/saro/',
			);
		$s = array_keys($subMenu);
		$mkey = array_search($parent,$m);
		$skey = array_search($child,$s);
		//default inclusion is home
		if ($child!=""){
			return array($m[0]=>$mainMenu[$m[0]],$m[$mkey]=>$mainMenu[$m[$mkey]],$s[$skey]=>$subMenu[$s[$skey]]);
		} else if ($parent==""){
			return array($m[0]=>$mainMenu[$m[0]]);
		} else {
			return array($m[0]=>$mainMenu[$m[0]],$m[$mkey]=>$mainMenu[$m[$mkey]]);
		}
	}
	public function AdminMapper($parent = false,$child = false){
		//the caption and the link
		$mainMenu = array(
			'Home'=>$this->base.'siteAdmin/',
			'System Setup'=>$this->base.'siteAdmin/sys_setup/',
			'Transaction'=>$this->base.'siteAdmin/transaction/',
			'Query'=>$this->base.'siteAdmin/query/',
			'Utilities'=>$this->base.'siteAdmin/utilities/'
			);
		$m = array_keys($mainMenu);
		$subMenu = array(
			'Appropriation Reference'=>$this->base.'siteAdmin/sys_setup/app_ref/',
			'P.P.A.'=>$this->base.'siteAdmin/sys_setup/ppa/',
			'Templates'=>$this->base.'siteAdmin/sys_setup/templates/',
			'Source Documents'=>$this->base.'siteAdmin/sys_setup/src_docs/',
			'Funds'=>$this->base.'siteAdmin/sys_setup/fund/',
			'Responsibility Center'=>$this->base.'siteAdmin/sys_setup/responsibilityCenter/',
			'Object of Expenditures'=>$this->base.'siteAdmin/sys_setup/expenditures/'
		);
		$s = array_keys($subMenu);
		$mkey = array_search($parent,$m);
		$skey = array_search($child,$s);
		//default inclusion is home
		if ($child!=""){
			return array($m[0]=>$mainMenu[$m[0]],$m[$mkey]=>$mainMenu[$m[$mkey]],$s[$skey]=>$subMenu[$s[$skey]]);
		} else if ($parent==""){
			return array($m[0]=>$mainMenu[$m[0]]);
		} else {
			return array($m[0]=>$mainMenu[$m[0]],$m[$mkey]=>$mainMenu[$m[$mkey]]);
		}
	}
	public function admin_menu(){
		$link = "sys_setup,transaction,queries,util,logout";
		$text = "System Setup,Transaction,Query,Utilities,Logout";
		$lnk = explode(",",$link); $txt = explode(",",$text);
		if (count ($lnk)!=count ($txt)){
			$mnu = "Links and Texts does not match with count.";
		} else {
		$mnu = array();
			for ($x = 0;$x<=count($lnk)-1;$x++){
				$mnu[$x]['link'] = $lnk[$x];
				$mnu[$x]['text'] = $txt[$x];
			}
		}
		return $mnu;
	}
	public function client_menu(){
		$link = "transaction,queries,util,logout";
		$text = "Transaction,Query,Utilities,Logout";
		$lnk = explode(",",$link); $txt = explode(",",$text);
		if (count ($lnk)!=count ($txt)){
			$mnu = "Links and Texts does not match with count.";
		} else {
		$mnu = array();
			for ($x = 0;$x<=count($lnk)-1;$x++){
				$mnu[$x]['link'] = $lnk[$x];
				$mnu[$x]['text'] = $txt[$x];
			}
		}
		return $mnu;
	}
	public function is_num($val){
		$pattern = "/[a-zA-Z]/";
		$r = preg_match($pattern, $val);
		return $r>=1 ? "false" : "true";
	}
	public function ppa_child($array){
		$this->load->database();
		if ($array['type']=="get"){
			$q = $this->db->query("select * from ppa_child where id='".$array['id']."'");
			$res = $q->result();
		}
		return $res;
	}
	public function saveSubparent($id,$code,$desc){
		$res = "";
			if (trim($code)==""){
				$res = "Invalid Code.";
			} else if (trim($desc)==""){
				$res = "Description must not be empty.";
			} else {
				$this->db->query("update ppa_child set childCode='".$code."',description='".$desc."' where id='$id'");
				$res = "true";
			}
		return $res;
	}
	public function deleteSubparent($id){
		$this->load->database();
		$this->db->query("delete from ppa_child where id='$id'");
		return "Successfully Deleted!";
	}
	public function loadFund(){
		session_start();
		$auth = $_SESSION['user_auth'];
		$this->load->database();
		$q = $this->db->query("select * from funds where agencyID='".$auth[0]->agencyID."'");
		return $q->result();
	}
	public function saveFund($type,$name){
		$this->load->database();
		session_start();
		$auth = $_SESSION['user_auth'];
		$q = $this->db->query("insert into funds values('','$type','$name','".$auth[0]->agencyID."')");
		return "true";
	}
	public function fund_action($type,$id){
		if ($type=="delete"){
			$this->load->database();
			$this->db->query("delete from funds where id='".$id."'");
		}
	}
	public function getFundData($id){
		$this->load->database();
		$q = $this->db->query("select * from funds where id='".$id."'");
		return $q->result();
	}
	public function saveModFund($type,$fund,$id){
		$this->load->database();
		$f = $this->db->query("update funds set type='$type',fund_desc='$fund' where id='$id'");
		return "true";
	}
}