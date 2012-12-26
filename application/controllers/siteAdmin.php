<?php
class siteAdmin extends CI_Controller{
	public $title = "COA Budget System (NGA)";
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
	}
	public function loadheader(){
		session_start();
		if ($_SESSION['user_auth']==""||!isset($_SESSION['user_auth'])){
			$this->logout();
		} else {
			$auth = $_SESSION['user_auth'];
				if ($auth[0]->type!="admin"){
					$this->logout();
				} else {
					$data['base_url'] = $this->coa_model->base_url();
					$data['title'] = $this->title;
					$this->load->view("common/header_",$data);
				}
		}
	}
	public function index($map_parent,$map_child){
		$this->loadheader();
		$data['base_url'] = $this->coa_model->base_url();
		$data['mnu'] = $this->coa_model->admin_menu();
		if ($map_parent==""&&$map_child==""){
			$map = $this->coa_model->AdminMapper();
		} else {
			$map = $this->coa_model->AdminMapper($map_parent,$map_child);	
		}
		$data['map'] = $map;
		if (!empty($map_child)){
			$data['active'] = $map_child;
		} else {
			$data['active'] = $map_parent;
		}
		$this->load->view("admin/index_",$data);
		
	}

	public function sys_setup($tag,$id){
		session_start();
		$auth = $_SESSION['user_auth'];
		$data['tag'] = $tag;
		$data['base_url'] = $this->coa_model->base_url();
		if ($tag=="app_ref"){
			$this->index('System Setup','Appropriation Reference');
			$this->load->view("admin/sys_setup_menu_",$data);
			$data['c_title'] = "Appropriation Reference";
			$this->load->view("admin/app_ref_",$data);
		} else if ($tag=="ppa"){
			$this->index('System Setup','P.P.A.');
			$this->load->view('admin/sys_setup_menu_',$data);
			
			$q = myDB_MODEL::fetch("ppa_category","","agencyID='".$auth[0]->agencyID."'");
			
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
			$this->load->view('admin/ppa_',$data);
		}else if ($tag=="templates"){
			$this->index('System Setup','Templates');
			$this->load->view('admin/sys_setup_menu_',$data);
			$data['c_title'] = "templates";

		} else if ($tag=="src_docs"){
			$this->index('System Setup','Source Documents');
			$this->load->view('admin/sys_setup_menu_',$data);
			$data['c_title']="src_docs";
		} else if ($tag=="fund"){
			$this->index('System Setup','Funds');
			$this->load->view('admin/sys_setup_menu_',$data);
			$data['c_title'] = "Funds";
			$data['fund_list'] = $this->coa_model->loadFund();
			if (isset($id)&&$id!=""){
				$this->coa_model->fund_action('delete',$id);
				header("location:".$this->coa_model->base_url()."siteAdmin/sys_setup/fund/");
			}
			$data['myid'] = $id;
			//$data['fund_data'] = $this->load->view('admin/fund_list_',$data);
			$this->load->view('admin/fund_',$data);
			$this->load->view('admin/fund_list_',$data);
		} else if ($tag=="responsibilityCenter") {

			$this->index('System Setup','Responsibility Center');

			$this->load->view("admin/sys_setup_menu_",$data);

			$data['c_title'] = "Responsibility Center";

			$this->load->view("admin/resp_center_",$data);

			$data['resp_list'] = myDB_MODEL::fetch("resp_center","","agencyID='".$auth[0]->agencyID."'");
			
			$this->load->view("admin/resp_center_list_",$data);

		} else if ($tag=="expenditures"){
			$this->index('System Setup','Object of Expenditures');
			$this->load->view("admin/sys_setup_menu_",$data);
			$this->load->view("admin/expenditures_",$data);
			$data['exp_list'] = myDB_MODEL::fetch("expenditures","","agencyID='".$auth[0]->agencyID."'");
			$this->load->view("admin/expend_list_",$data);
		} else {
			$this->index('System Setup');
			$data['c_title'] = "Source Documents";
			$this->load->view("admin/sys_setup_menu_",$data);
		}
	}
	public function app_add(){
		$data['base_url'] = $this->coa_model->base_url();
		$this->load->view("admin/add_app_",$data);
		return false;
	}
	public function validate_app_add(){
		$errs = array();
		if (trim(strip_tags($_GET['legal']))==""){
			array_push($errs,"Invalid Legal Basis Value, It must be properly filled up.");
		} if ($this->coa_model->is_num($_GET['span'])=="false"||trim($_GET['span'])==""){
			array_push($errs,"Year Span must be numerical.");
		} if ($_GET['app']==""){
			array_push($errs,"Please Specify Appropriation Type.");
		}
		if (count ($errs)>=1){
			$data['errors'] = $errs;
			$this->load->view("common/error_hndler_",$data);
		} else {
			session_start();
			$u_auth = $_SESSION['user_auth'];
			
			$q=myDB_MODEL::fetch("bs_apro_detail","","legal_basis='".$_GET['legal']."' and year='".$_GET['year']."'");
			if (count ($q)>=1){
				$data['errors'] = array('Your Data Entry is already Enlisted in the records, Same Legal basis and Same Year Entry.');
			} else {
				myDB_MODEL::insert("bs_apro_detail","'','".$_GET['legal']."','".$_GET['yr']."','".$_GET['span']."','".$_GET['app']."','".$_GET['app_type']."','".$u_auth[0]->agencyID."'");
				echo "Data Successfully Saved.";
			}
		}
		return false;
	}
	public function app_list(){
		session_start();
		$auth = $_SESSION['user_auth'];
			
				$q = myDB_MODEL::fetch("bs_apro_detail","","agencyID='".$auth[0]->agencyID."'");
			$data['list'] = $q;
			$data['base_url'] = $this->coa_model->base_url();
			$this->load->view("admin/appro_list_",$data);
		return false;
	}
	public function appro_delete(){
		
		myDB_MODEL::delete("bs_apro_detail","id='".$_GET['id']."'");
		echo "Successfully Deleted.";
		return false;
	}
	public function appro_edit(){
		
		$q = myDB_MODEL::fetch("bs_apro_detail","","id='".$_GET['id']."'");
		$data['info'] = $q;
		$data['base_url'] = $this->coa_model->base_url();
		$this->load->view("admin/appro_edit_",$data);
		return false;
	}
	public function apro_editNow(){
		$errs = array();
		if (trim(strip_tags($_GET['legal']))==""){
			array_push($errs,"Invalid Legal Basis Value, It must be properly filled up.");
		} if ($this->coa_model->is_num($_GET['span'])=="false"||trim($_GET['span'])==""){
			array_push($errs,"Year Span must be numerical.");
		} if ($_GET['app']==""){
			array_push($errs,"Please Specify Appropriation Type.");
		}
		if (count ($errs)>=1){
			echo "There are errors encountered. <br/><ul>";
			for($cnt =0;$cnt<=count($errs)-1;$cnt++){
				echo "<li>".$errs[$cnt]."</li>";
			} echo "</ul>";
			
		} else {
						
			myDB_MODEL::update("bs_apro_detail",array("legal_basis","year","span","app","app_type"),array($_GET['legal'],$_GET['yr'],$_GET['span'],$_GET['span'],$_GET['app_type']),"id='".$_GET['id']."'");
			echo "Successfully Modified the APPRO Detail.";
		}
		return false;
	}
	public function search_appro(){
		session_start();
		$auth = $_SESSION['user_auth'];
	
		$data['base_url'] = $this->coa_model->base_url();
		if ($_GET['value']!=""){
		$q = myDB_MODEL::fetch("bs_apro_detail","","legal_basis like '%".$_GET['value']."%' and agencyID='".$auth[0]->agencyID."' or year like '%".$_GET['value']."%' and agencyID='".$auth[0]->agencyID."'");
		} else {
			$q = myDB_MODEL::fetch("bs_apro_detail","","agencyID='".$auth[0]->agencyID."'");
		}
		$data['list'] = $q;
		$this->load->view("admin/appro_list_",$data);
		return false;
	}
	public function ppa_add(){
		$data['base_url'] = $this->coa_model->base_url();
		session_start();
		$auth = $_SESSION['user_auth'];
		
		if ($_GET['type']=="parent"){
			$data['type']="add";
			$this->load->view('admin/ppa_parent_',$data);
		} else if ($_GET['type']=="addparentnow"){
			$f = myDB_MODEL::fetch("ppa_category","","ppa_code='".$_GET['code']."' and agencyID='".$auth[0]->agencyID."'");
			if (count($f)>=1){
				echo "You entered an existing PPA CODE.";
			} else if (trim($_GET['code'])==""||trim($_GET['desc'])==""){
				echo "Please Properly fill out all the required fields.";
			} else {
				myDB_MODEL::insert("ppa_category","'','".$_GET['code']."','".$_GET['desc']."','".$auth[0]->agencyID."'");
				echo "Add Successful!";
			}
		} else if ($_GET['type']=="subparent"){
			$data['type']="subparent";
			$data['id'] = $_GET['id'];
			$this->load->view('admin/ppa_parent_',$data);
		} else if ($_GET['type']=="add_subParentNow"){
			$verify = myDB_MODEL::fetch("ppa_child","","ppaID='".$_GET['category']."' and childCode='".$_GET['code']."' and description='".$_GET['desc']."' and agencyID='".$auth[0]->agencyID."' ");
			if (count($verify)>=1){
				echo "You Entered an existing PPA Sub Category Details.";
			} else if (trim($_GET['code'])==""){
				echo "You are required to fill up the Code Detial.";
			} else if (trim($_GET['desc'])==""){
				echo "PPA Sub Category Description must be filled up.";
			} else {
				
				$ref = myDB_MODEL::fetch("ppa_category","","ppaID='".$_GET['category']."'");
				myDB_MODEL::insert("ppa_child","'','".$_GET['category']."','".$ref[0]->ppa_code."','".$_GET['code']."','".$_GET['desc']."','".$auth[0]->agencyID."'");
				echo "Add Successfull!";
			}
		} else if ($_GET['type']=="subparentmod"){
			
			$vald = $this->coa_model->saveSubparent($_GET['id'],$_GET['code'],$_GET['desc']);
			if ($vald == "true"){
				echo "Successfully Modified!";
			} else {
				echo $vald;
			}
		}
		return false;
	}
	public function ppa_sub_list(){
		
		session_start();
		$auth = $_SESSION['user_auth'];
		$data['base_url'] = $this->coa_model->base_url();
		
		$data['mres'] = myDB_MODEL::fetch("ppa_child","","ppaID='".$_GET['id']."' and agencyID='".$auth[0]->agencyID."'");
		$this->load->view("admin/ppa_sub_list_",$data);
		return false;
	}

	public function SubParent(){
	
		if ($_GET['type']=="modify"){
			$data['type'] = "modify_subparent";
			$data['base_url'] = $this->coa_model->base_url();
			$data['fields'] = $this->coa_model->ppa_child(array('type'=>'get','id'=>$_GET['id']));
			$this->load->view('admin/ppa_parent_',$data);
		} else if($_GET['type']=="deletenow"){
			$r = $this->coa_model->deleteSubparent($_GET['id']);
			echo $r;
		}
		return false;
	}

	public function add_fund(){
		$data['base_url'] = $this->coa_model->base_url();
		if ($_GET['type']=="add"){
			$this->load->view('admin/add_fund_',$data);
		} else if ($_GET['type']=="saveNow"){
			if (trim ($_GET['name'])==""){
				echo "Invalid Fund Name.";
			} else if (count(myDB_MODEL::fetch("funds","","fund_desc='".$_GET['name']."' and type='".$_GET['f_type']."'"))>=1){
				echo "Fund Details Already Exists!";
			}else {
				$q = $this->coa_model->saveFund($_GET['f_type'],$_GET['name']);
				if ($q=="true" ){
					echo "Successfully Saved.";
				} else {
					echo $q;
				}
			}
		} else if ($_GET['type']=="modify"){
			$data['fund'] = $this->coa_model->getFundData($_GET['id']);
			$data['type'] = "mod";
			$this->load->view("admin/add_fund_",$data);
		} else if ($_GET['type']=="saveMod"){
			$q = $this->coa_model->saveModFund($_GET['f_type'],$_GET['name'],$_GET['id']);
			if ($q=="true"){
				echo "Successfully Saved.";
			}
		}
		return false;
	}
	public function search_fund(){
		session_start();
		$auth = $_SESSION['user_auth'];
		if (trim($_GET['value'])!=""){
			$data['fund_list'] = myDB_MODEL::fetch("funds","","fund_desc like '%".$_GET['value']."%' and agencyID='".$auth[0]->agencyID."'");
		} else {
			$data['fund_list'] = myDB_MODEL::fetch("funds","","agencyID='".$auth[0]->agencyID."'");
		}
		$this->load->view('admin/fund_list_',$data);
	}
	public function resp_centerControl(){
		session_start();
		$auth = $_SESSION['user_auth'];
		$data['base_url'] = $this->coa_model->base_url();
		$data['type'] = $_GET['type'];
		if ($_GET['type']=="add"||$_GET['type']=="delete"){
			if (isset($_GET['id'])){
				$data['theId'] = $_GET['id'];
			}
			$this->load->view("admin/resp_control_",$data);
		} else if ($_GET['type']=="addNow"){
			$q = myDB_MODEL::fetch("resp_center","","code='".$_GET['resp_code']."' and resp_desc='".$_GET['resp_desc']."' and agencyID='".$auth[0]->agencyID."' or code='".$_GET['resp_code']."' and agencyID='".$auth[0]->agencyID."'");
			if (trim($_GET['resp_code'])==""){
				echo "Responsibility Code must be filled up.";
			} else if (trim($_GET['resp_desc'])==""){
				echo "Please properly fill out the Responsibility Description.";
			} else if (count($q)>=1){
				echo "Responsibility Code already exists.";
			} else {
				myDB_MODEL::insert("resp_center","'','".$_GET['resp_code']."','".$_GET['resp_desc']."','".$auth[0]->agencyID."'");
				echo "Successfully Saved!";
			}
		} else if ($_GET['type']=="edit"){
			$data['selected'] = myDB_MODEL::fetch("resp_center","","id='".$_GET['id']."'");
			$this->load->view("admin/resp_control_",$data);
		} else if ($_GET['type']=="saveMod"){
			if (trim($_GET['resp_code'])==""){
				echo "Responsibility Code must be filled up.";
			} else if (trim($_GET['resp_desc'])==""){
				echo "Please properly fill out the Responsibility Description.";
			} else if (count($q)>=1){
				echo "Responsibility Code already exists.";
			} else {
				myDB_MODEL::update("resp_center",array('code','resp_desc'),array($_GET['resp_code'],$_GET['resp_desc']),"id='".$_GET['id']."'");
				echo "Successfully Saved!";
			}
		} else if ($_GET['type']=="deleteNow"){
			myDB_MODEL::delete("resp_center","id='".$_GET['id']."'");
			echo "Successfully Removed!";
		}
	}

	public function search_resp(){
		session_start();
		$auth = $_SESSION['user_auth'];
		$data['base_url'] = $this->coa_model->base_url();
		if (trim($_GET['val'])!=""){
			$data['resp_list'] = myDB_MODEL::fetch("resp_center","","code like '%".$_GET['val']."%' and agencyID='".$auth[0]->agencyID."' or resp_desc like '%".$_GET['val']."%' and agencyID='".$auth[0]->agencyID."'");
		} else {
			$data['resp_list'] = myDB_MODEL::fetch("resp_center","","agencyID='".$auth[0]->agencyID."'");
		}
		$this->load->view("admin/resp_center_list_",$data);
	}

	public function exp_control(){
		session_start();
		$auth = $_SESSION['user_auth'];
		$data['base_url'] = $this->coa_model->base_url();
		$data['type'] = $_GET['type'];
		if ($_GET['type']=="add"||$_GET['type']=="delete"){
			if (isset($_GET['id'])){
				$data['theId'] = $_GET['id'];
			}
			$this->load->view("admin/exp_control_",$data);
		} else if ($_GET['type']=="addNow"){
			$q = myDB_MODEL::fetch("expenditures","","code='".$_GET['exp_code']."' and exp_desc='".$_GET['exp_desc']."' and agencyID='".$auth[0]->agencyID."' or code='".$_GET['exp_code']."' and agencyID='".$auth[0]->agencyID."'");
			if (trim($_GET['exp_code'])==""){
				echo "Expenditure Code must be filled up.";
			} else if (trim($_GET['exp_desc'])==""){
				echo "Please properly fill out the Expenditure Description.";
			} else if (count($q)>=1){
				echo "Expenditure Code already exists.";
			} else {
				myDB_MODEL::insert("expenditures","'','".$_GET['exp_code']."','".$_GET['exp_desc']."','".$auth[0]->agencyID."'");
				echo "Successfully Saved!";
			}
		} else if ($_GET['type']=="edit"){
			$data['selected'] = myDB_MODEL::fetch("expenditures","","id='".$_GET['id']."'");
			$this->load->view("admin/exp_control_",$data);
		} else if ($_GET['type']=="saveMod"){
			if (trim($_GET['exp_code'])==""){
				echo "Responsibility Code must be filled up.";
			} else if (trim($_GET['exp_desc'])==""){
				echo "Please properly fill out the Expenditure Description.";
			} else if (count($q)>=1){
				echo "Expenditure Code already exists.";
			} else {
				myDB_MODEL::update("expenditures",array('code','exp_desc'),array($_GET['exp_code'],$_GET['exp_desc']),"id='".$_GET['id']."'");
				echo "Successfully Saved!";
			}
		} else if ($_GET['type']=="deleteNow"){
			myDB_MODEL::delete("expenditures","id='".$_GET['id']."'");
			echo "Successfully Removed!";
		}
	}
	public function search_exp(){
		session_start();
		$auth = $_SESSION['user_auth'];
		$data['base_url'] = $this->coa_model->base_url();
		if (trim($_GET['val'])!=""){
			$data['exp_list'] = myDB_MODEL::fetch("expenditures","","code like '%".$_GET['val']."%' and agencyID='".$auth[0]->agencyID."' or exp_desc like '%".$_GET['val']."%' and agencyID='".$auth[0]->agencyID."'");
		} else {
			$data['exp_list'] = myDB_MODEL::fetch("expenditures","","agencyID='".$auth[0]->agencyID."'");
		}
		$this->load->view("admin/expend_list_",$data);
	}
	public function logout(){
		session_start();
		session_destroy();
		header("location:".$this->coa_model->base_url()."coa/");	
	}

}