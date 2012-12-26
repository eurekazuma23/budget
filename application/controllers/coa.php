<?php
class coa extends CI_Controller{
	
	public $title = "COA Budget System (NGA)";
	public $path = "http://localhost/budget/";
	public function base_url(){
		return $this->path;
	}
	
	public function loadheader(){
		$data['base_url'] = $this->base_url();
		$data['title'] = $this->title;
		$this->load->view("common/header_",$data);
	}
	public function index(){
		$this->login();
	}
	public function login(){
		$this->loadheader();

			if (isset($_POST['auth'])){
				$this->load->database();
				//$data['auth'] = $this->coa_model->auth($_POST['user'],$_POST['pass']);
				$q = $this->db->query("select * from users where username='".$_POST['user']."' and password='".sha1($_POST['pass']."_system")."'");
				if ($q->num_rows()<=0){
					$data['auth'] = "Invalid Username / Password.";
				} else {
					$qres = $q->result();
						session_start();
						$_SESSION['user_auth'] = $qres;
					if ($qres[0]->type=="admin"){
						header("location:".$this->base_url()."siteAdmin/");	
					} else {
						header("location:".$this->base_url()."client/");
					}
				}
			}
					$data['none'] = "";
		$this->load->view("pages/index_",$data);
		$this->load->view("common/footer_");
	}
	
}