<?php
	class client extends CI_Controller{
		public $map;
		public $title = "COA Budget System (NGA)";
		public function base_url(){
			return $this->path;
		}
		public function __construct(){
			parent::__construct();
		}
		// public function query(){
		// 	$this->load->view("client/index_");
		// 	$this->index();	
		// }
		// public function loadheader(){
		// 	$this->load->view("client/index_");
		// 	$this->index();
		// }
		public function loadheader(){
			session_start();
			if ($_SESSION['user_auth']==""||!isset($_SESSION['user_auth'])){
				$this->logout();
			} else {
				$auth = $_SESSION['user_auth'];
					if ($auth[0]->type!="client"){
						$this->logout();
					} else {
						$data['base_url'] = $this->coa_model->base_url();
						$data['title'] = $this->title;
						$this->load->view("common/header_",$data);
					}
			}
		}
		public function index($main,$child){
			$this->loadheader();
			$data['base_url'] = $this->coa_model->base_url();
			$data['mnu'] = $this->coa_model->client_menu();
			$data['map'] = $this->coa_model->ClientMapper($main,$child);
			if ($child!=""){
				$data['active'] = $child;
			} else {
				$data['active'] = $main;
			}
			$this->load->view("client/index_",$data);
			
		}

		public function transaction($tag = false){
			//$this->loadheader();
			$data['base_url'] = $this->coa_model->base_url();
			$data['tag'] = $tag;
			$this->map = "test";
				if ($tag=="saro"){
					$this->index('Transaction','Special Allotment');
					$this->load->view("client/trans_",$data);
					$this->load->view("client/saro_index_",$data);
					//$this->saro();
				} else if ($tag=="needingClearance"){
					$this->index('Transaction','Needing Clearance');
					$this->load->view("client/trans_",$data);
					$this->load->view("client/saro_index_",$data);

				} else if ($tag=="NotneedingClearance"){
					$this->index('Transaction','Not Needing Clearance');
					$this->load->view("client/trans_",$data);
					$this->load->view("client/not_need_index_",$data);	

				} else {
					$this->index('Transaction');
					$this->load->view("client/trans_",$data);
				}
		}
		
		public function saro(){
			session_start();
			$auth = $_SESSION['user_auth'];
			$data['user'] = myDB_MODEL::fetch("user_info","","uid='".$auth[0]->uid."'");
			$data['fund'] = myDB_MODEL::fetch("funds","","agencyID='".$auth[0]->agencyID."'");
			$data['legal_basis'] = myDB_MODEL::fetch("bs_apro_detail","","agencyID='".$auth[0]->agencyID."'");
			$data['base_url'] = $this->coa_model->base_url();
			$this->load->view("client/saro_index_",$data);
		}


		public function allotment(){
			session_start();
			$auth = $_SESSION['user_auth'];
			$f = myDB_MODEL::fetch("saro_transaction","","transaction_id='".$_GET['saro']."'");
			if (count($f)<=0){
				echo "Please Save the saro transaction first.<br/><button class='btn btn-primary' onclick='hideMes()'><i class='icon-white icon-ok'></i> Okay</button>";
			} else {
				$q = myDB_MODEL::fetch("ppa_category","","agencyID='".$auth[0]->agencyID."'");
				$data['base_url'] = $this->coa_model->base_url();
				$data['ppa_list'] = $q;
				$d = $q;
					$pr = 0;
					$child = array();
					while ($pr<=count($d)-1){
						$fnd = myDB_MODEL::fetch("ppa_child","","ppaID='".$d[$pr]->ppaID."'");
						
						$child[$d[$pr]->ppaID]['results'] = $fnd;
						$pr++;
					}
				$data['ppa_child'] = $child;
				$data['resp_center'] = myDB_MODEL::fetch("resp_center","","agencyID='".$auth[0]->agencyID."'");
				$data['classID'] = $_GET['class'];
				$this->load->view('client/saro_allotment_',$data);
			}
		}
	
		public function nnc_allotment(){
			session_start();
			$auth = $_SESSION['user_auth'];
			$f = myDB_MODEL::fetch("nnc_transaction","","id='".$_GET['id']."'");
			if (count($f)<=0){
				echo "Please Save the transaction first.<br/><button class='btn btn-primary' onclick='hideMes()'><i class='icon-white icon-ok'></i> Okay</button>";
			} else {
				$q = myDB_MODEL::fetch("ppa_category","","agencyID='".$auth[0]->agencyID."'");
				$data['base_url'] = $this->coa_model->base_url();
				$data['ppa_list'] = $q; 
				$d = $q;
					$pr = 0;
					$child = array();
					while ($pr<=count($d)-1){
						$fnd = myDB_MODEL::fetch("ppa_child","","ppaID='".$d[$pr]->ppaID."'");
						
						$child[$d[$pr]->ppaID]['results'] = $fnd;
						$pr++;
					}
				$data['ppa_child'] = $child;
				$data['resp_center'] = myDB_MODEL::fetch("resp_center","","agencyID='".$auth[0]->agencyID."'");
				$data['classID'] = $_GET['class'];
				$this->load->view('client/nnc_allotment',$data);
			}
		}

		public function not_need_controller(){
			session_start();
			$auth = $_SESSION['user_auth'];
			$data['user'] = myDB_MODEL::fetch("user_info","","uid='".$auth[0]->uid."'");
			$data['fund'] = myDB_MODEL::fetch("funds","","agencyID='".$auth[0]->agencyID."'");
			$data['legal_basis'] = myDB_MODEL::fetch("bs_apro_detail","","agencyID='".$auth[0]->agencyID."'");
			$data['base_url'] = $this->coa_model->base_url();
			if ($_GET['type']=="add"){
				$this->load->view("client/not_need_",$data);
			} else if ($_GET['type']=="records"){
				$data['records'] = myDB_MODEL::fetch("nnc_transaction","","agencyID='".$auth[0]->agencyID."'");
				$this->load->view("client/not_need_list_",$data);
			}
			return false;
		}
	
		public function saro_controller(){
			session_start();
			$auth = $_SESSION['user_auth'];
			$data['user'] = myDB_MODEL::fetch("user_info","","uid='".$auth[0]->uid."'");
			$data['fund'] = myDB_MODEL::fetch("funds","","agencyID='".$auth[0]->agencyID."'");
			$data['legal_basis'] = myDB_MODEL::fetch("bs_apro_detail","","agencyID='".$auth[0]->agencyID."'");
			$data['base_url'] = $this->coa_model->base_url();
			if ($_GET['type']=="add"){
				$this->load->view("client/saro_",$data);
			} else if ($_GET['type']=="records"){
				$data['records'] = myDB_MODEL::fetch("saro_transaction","","agencyID='".$auth[0]->agencyID."'");
				$this->load->view("client/saro_list_",$data);
			}
			return false;
		}
		public function expends_list(){
			session_start();
			$auth = $_SESSION['user_auth'];
			$data['expends'] = myDB_MODEL::fetch("expenditures","","agencyID='".$auth[0]->agencyID."'");
			$this->load->view("client/expends_list_",$data);
		}
		public function save_saro(){
			session_start();
			$auth = $_SESSION['user_auth'];
			$check = myDB_MODEL::fetch("saro_transaction","","transaction_id='".$_GET['saroid']."'");
			if (count($check)>0){
				echo "Please Specify Another Transaction Number! ".$_GET['saroid']." is already exists in the records!";
			} else {
				myDB_MODEL::insert("saro_transaction","'','".$auth[0]->agencyID."','".$_GET['saroid']."','".$_GET['d_date']."','".$_GET['t_date']."','".$_GET['fund']."','".$_GET['l_basis']."','".$_GET['purpose']."','".$auth[0]->id."',''");
				echo "Successfully Saved!";
			}
		}
		
		public function save_nnc(){
		 	session_start();
		 	$auth = $_SESSION['user_auth'];
		 	myDB_MODEL::insert("nnc_transaction","'','".$auth[0]->agencyID."','".$_GET['n_date']."','".$_GET['fund']."','".$_GET['l_basis']."','".$auth[0]->id."',''");
			echo "Successfully Saved!";
		 	}
		
		public function ppa_detail(){
			session_start();
			$auth = $_SESSION['user_auth'];
			$data['base_url'] = $this->coa_model->base_url();
			$s = myDB_MODEL::fetch("saro_transaction","","transaction_id='".$_GET['saro']."' and agencyID='".$auth[0]->agencyID."'");
			if (empty($_GET['ppa'])){
				$data['status'] = "Please select PPA Details";
			} else if (empty($_GET['exp'])){
				$data['status'] = "Please Specify Details in Object of Expenditures";
			} else if ($this->coa_model->is_num($_GET['amt'])=="false"||empty($_GET['amt'])){
				$data['status'] = "Invalid Amount Value.";
			} else {
				$data['status'] = "true";
				$ppa = explode("/",$_GET['ppa']);
				$resp = explode("/",$_GET['resp_center']);
				$q = myDB_MODEL::insert("allotment_class_details","'','".$_GET['class_id']."','".$ppa[0]."','".$ppa[1]."','".$_GET['ppaCode']."','".$resp[0]."','".$resp[1]."','".$_GET['exp']."','".$_GET['expval']."','".$s[0]->id."','".$_GET['amt']."'");
			}
				$data['class_id'] = $_GET['class_id'];
				$data['list'] = myDB_MODEL::fetch("allotment_class_details","","saroID='".$s[0]->id."' and class_id='".$_GET['class_id']."'");
				$this->load->view("client/tbody_ppa_",$data);
		}

		public function ppa_det_obj(){
			session_start();
			$auth = $_SESSION['user_auth'];
			$data['base_url'] = $this->coa_model->base_url();
			$s = myDB_MODEL::fetch("nnc_transaction","","trans_num'".$_GET['nnc_trans']."' and agencyID='".$auth[0]->agencyID."'");
			if (empty($_GET['ppa'])){
				$data['status'] = "Please Select PPA Details";
			}else if($this->coa_model->is_num($_GET['allotamt'])=="false"||empty($_GET['allotamt'])){
				$data['status'] = "Invalid Amount Value.";
			}else{
				$data['status']="true";
				$ppa=explode("/",$_GET['ppa']);
				$allotamt=explode("/",$_GET['allotamt']);
				$q=myDB_MODEL::insert("");
			}
		}
		public function del_allotment(){
			myDB_MODEL::delete("allotment_class_details","id='".$_GET['id']."'");
			echo "Successfully Removed!";
		}
		public function del_saro(){
			myDB_MODEL::delete("saro_transaction","id='".$_GET['id']."'");
			echo "Successfully Removed!";
		}
		public function del_nnc(){
			myDB_MODEL::delete("nnc_transaction","id='".$_GET['id']."'");
			echo "Successfully Removed!";
		}

		public function logout(){
			session_start();
			session_destroy();
			header("location:".$this->coa_model->base_url()."coa/");	
		}
		public function load_ppa(){
			session_start();
			$auth = $_SESSION['user_auth'];
			$q = myDB_MODEL::fetch("ppa_category","","agencyID='".$auth[0]->agencyID."'");
			$data['base_url'] = $this->coa_model->base_url();
			$data['ppa_list'] = $q;
			$d = $q;
				$pr = 0;
				$child = array();
				while ($pr<=count($d)-1){
					$fnd = myDB_MODEL::fetch("ppa_child","","ppaID='".$d[$pr]->ppaID."'");
					
					$child[$d[$pr]->ppaID]['results'] = $fnd;
					$pr++;
				}
			$data['ppa_child'] = $child;
			$this->load->view("client/ppa_listing_",$data);
		}
		public function load_allotment(){
			session_start();
			$auth = $_SESSION['user_auth'];
			$data['base_url'] = $this->coa_model->base_url();
			$s = myDB_MODEL::fetch("saro_transaction","","transaction_id='".$_GET['saro']."' and agencyID='".$auth[0]->agencyID."'");
			$data['list'] = myDB_MODEL::fetch("allotment_class_details","","saroID='".$s[0]->id."' and class_id='".$_GET['class_id']."'");
			$this->load->view("client/tbody_ppa_",$data);
		}
		public function a_reload(){
			session_start();
			$auth = $_SESSION['user_auth'];
			$data['base_url'] = $this->coa_model->base_url();
			$s = myDB_MODEL::fetch("saro_transaction","","transaction_id='".$_GET['saro']."' and agencyID='".$auth[0]->agencyID."'");
			$data['list'] = myDB_MODEL::fetch("allotment_class_details","","saroID='".$s[0]->id."'");
			$this->load->view("client/allotment_load_",$data);
			return false;
		}
	}