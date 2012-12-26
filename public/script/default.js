function ajax(){
	var xmlhttp;
		if (window.ActiveXObject){
			xmlhttp = new ActiveXObject("microsoft.XMLHTTP");
		} else {
			xmlhttp = new XMLHttpRequest();
		}
		return xmlhttp;
}

function center(id){
	var winWidth = window.innerWidth/2;
	var winHeight = window.innerHeight/2;
	var dvH = $("#"+id).height()/2;
	var dvW = $("#"+id).width()/2;
	var left = winWidth-dvW;
	var top = winHeight-dvH;
	$("#"+id).css({"margin-top":top+"px","margin-left":left+"px"});
	
}
function getAppRef(id,base){

	var last = document.getElementById('last');

	var actv = document.getElementById(id);
		if (last.value!=""){
			if (id!=last.value){
				document.getElementById(last.value).setAttribute("class","");
			}
		}
		actv.setAttribute("class","active");
		last.value=id;
	/*
		*/
		fetch_content(id,base);
}
function fetch_content(id,base){
	var xml = new ajax();
	if (id=="add_app_list"){
		xml.open("GET",base+"siteAdmin/app_add",true);
		$(".hiddenSearch").fadeOut("slow");
	} else if (id=="view_app_list"){
		xml.open("GET",base+"siteAdmin/app_list",true);
		$(".hiddenSearch").effect("bounce",500);
	}
	xml.onreadystatechange=function(){
		if (xml.readyState==4){
			document.getElementById('tab_content').innerHTML = xml.responseText;
		}
	}
	xml.send();
}
function yr_nav(type){
	if (type=="add"){
		document.getElementById('yr').value = parseInt(document.getElementById('yr').value)+1;
	} else {
		document.getElementById('yr').value = parseInt(document.getElementById('yr').value)-1;
	}
}

function app_type(id){
	
	var sel = document.getElementById('c_sel');
	var l = document.getElementById(id);	
		if (sel.value!=""){
			if (sel.value!=id){
				var s = document.getElementById(sel.value);
				s.setAttribute("class","btn btn-primary");
				
			}
		}
	l.setAttribute("class","btn btn-warning");
	
	sel.value=id;
}
function centering(){
	var winH = window.innerHeight/2;
	var winW = window.innerWidth/2;
	var dvH = $("#hiddenMsgbox").height()/2;
	var dvW = $("#hiddenMsgbox").width()/2;
	var top = winH-dvH;
	var left = winW-dvW
			$("#overall").fadeIn("slow");
			$("#hiddenMsgbox").css({"top":top+"px","left":winW-dvW+"px"});
			$("#hiddenMsgbox").fadeIn("fast");
			$("body").css({"overflow":"hidden"});
	}
function hideMes(){
	
	$("#overall").fadeOut("fast");
	$("#hiddenMsgbox").effect("bounce",200,function(){
		$("#hiddenMsgbox").effect("explode",500,function(){
			$('#hiddenMsgbox').html("");
		});
	});
	$("#hiddenMsgbox").css({"top":0,"left":0});
	$("body").css({"overflow":"auto"});
}
function check_add_app(base){
	//centering();
	var legal = document.getElementById('legal');
	var yr = document.getElementById('yr');
	var span = document.getElementById('span');
	var app = document.getElementById('c_sel');
	var app_type = document.getElementById('app_type');
	var xml = new ajax();
	xml.open("GET",base+"siteAdmin/validate_app_add/?legal="+legal.value+"&yr="+yr.value+"&span="+span.value+"&app="+app.value+"&app_type="+app_type.value,true);
	xml.onreadystatechange=function(){
		if (xml.readyState==4){
				if (xml.responseText=="Data Successfully Saved."){
					document.getElementById('hiddenMsgbox').innerHTML = "<center>"+xml.responseText+"<br/>Redirecting <img src='"+base+"public/images/loading.gif'/></center>";
						fetch_content("add_app_list",base);
						setTimeout('hideMes()',2000);
				} else {
					$("#hiddenMsgbox").css({"background":"white"});
					document.getElementById('hiddenMsgbox').innerHTML = xml.responseText;
				}
			centering(); 
		}
	}
	xml.send();
}
function check_edit_app(id,base){
	$(".msg").html("<img src='"+base+"public/images/loading.gif'/> Processing Please Wait..");
	$(".msg").fadeIn("fast");
	centering();
	var legal = document.getElementById('legal');
	var yr = document.getElementById('yr');
	var span = document.getElementById('span');
	var app = document.getElementById('c_sel');
	var app_type = document.getElementById('app_type');

	var ax = new ajax();
	ax.open("GET",base+"siteAdmin/apro_editNow/?legal="+legal.value+"&yr="+yr.value+"&span="+span.value+"&app="+app.value+"&app_type="+app_type.value+"&id="+id,true);
	ax.onreadystatechange=function(){
		if (ax.readyState==4){
			if (ax.responseText!="Successfully Modified the APPRO Detail."){
				$(".error-wr").html(ax.responseText);
				$(".error-wr").fadeIn("fast");
				centering();
				$(".msg").fadeOut("fast");
			} else {
				$("#hiddenMsgbox").html(ax.responseText);
				centering();
				fetch_content("view_app_list",base);
				setTimeout('hideMes()',2000);
			}
			/*
			*/
		}
	}
	ax.send();
}
function redirect(url){
	document.location.href=url;
}

function app_action(type,id,base){
	//centering();
	var xml = new ajax();
	if (type=="delete"){
		xml.open("GET",base+"siteAdmin/appro_delete/?id="+id,true);
	} else if (type=="edit"){
		xml.open("GET",base+"siteAdmin/appro_edit/?id="+id,true);
	}
	xml.onreadystatechange=function(){
		if (xml.readyState==4){
			document.getElementById('hiddenMsgbox').innerHTML = xml.responseText;
				if (type=="delete"){
					if (xml.responseText=="Successfully Deleted."){
						fetch_content("view_app_list",base);
						setTimeout('hideMes()',2000);
					}
				}
			centering();
		}
	}
	xml.send();
}
function search_appro(value,base){
var xml = new ajax();
	xml.open("GET",base+"siteAdmin/search_appro/?value="+value,true);
	xml.onreadystatechange=function(){
		if (xml.readyState==4){
			document.getElementById('tab_content').innerHTML = xml.responseText;
		}
	}
	xml.send();

}
function ppa_action(tpe,base){
	var type = document.getElementById('tree_last');
	var child = document.getElementById('child');
	var code = document.getElementById('ppa_code');
	var desc = document.getElementById('ppa_desc');
				
	var xml = new ajax();
		if (type.value=="0"){
			if (tpe=="add_parentNow"){
				xml.open("GET",base+"siteAdmin/ppa_add/?type=addparentnow&code="+code.value+"&desc="+desc.value,true);
			} else { xml.open("GET",base+"siteAdmin/ppa_add/?type=parent",true); }
		} else if (type.value!=0){
			if (tpe=="add_subParentNow"){
				var cat_id = document.getElementById('ppa_cat_id');
				xml.open("GET",base+"siteAdmin/ppa_add/?type=add_subParentNow&code="+code.value+"&desc="+desc.value+"&category="+cat_id.value,true);
			} else if (tpe=="save_mod_subparent"){
				//alert("aaa");
				var subparent = document.getElementById('subparentID');
				xml.open("GET",base+"siteAdmin/ppa_add/?type=subparentmod&id="+subparent.value+"&code="+code.value+"&desc="+desc.value,true);
			} else {
			xml.open("GET",base+"siteAdmin/ppa_add/?type=subparent&id="+type.value,true);
			}
		} 
		xml.onreadystatechange=function(){
			if (xml.readyState==4){
				if (tpe=="add_parentNow"){
					if (xml.responseText!="Add Successful!"){
						$(".error-wr").html(xml.responseText);
						$(".error-wr").fadeIn("fast");
						centering();
					} else { redirect(base+'siteAdmin/sys_setup/ppa/'); }
				} else if (tpe=="add_subParentNow") {
					if (xml.responseText!="Add Successfull!"){
						$(".error-wr").html(xml.responseText);
						$(".error-wr").fadeIn("fast");
						centering();
					} else {
						$("#hiddenMsgbox").html(xml.responseText);
						setTimeout('hideMes()',2000);
						loadPPa_list();
					}
				} else if (tpe=="save_mod_subparent") {
					if (xml.responseText!="Successfully Modified!"){
						$(".error-wr").html(xml.responseText);
						$(".error-wr").fadeIn("fast");
						centering();
					} else {
						$("#hiddenMsgbox").html(xml.responseText);
						setTimeout('hideMes()',2000);
						loadPPa_list();
					}
				} else {
					$("#hiddenMsgbox").html(xml.responseText);
					centering();
				}
			}
		}
		xml.send();
}
function parent_activ(val,id){
//	alert(id);
	var txt = document.getElementById('parent');
	var last = document.getElementById('tree_last');
	if (last.value!=id){
		$("#"+id).css({"text-decoration":"underline","color":"black"});
		$("#"+last.value).css({"text-decoration":"none","color":""});

	}
	last.value = id;
	txt.value = val;
	loadPPa_list();
}
function showUl(id,ppaid){
	//alert(id);
	document.getElementById('parent').value=ppaid;
	$("#"+id).slideToggle("fast");
}
function loadPPa_list(){
	var p = document.getElementById('tree_last');
	var base = document.getElementById("url").value;
	//alert(base);
	if (p.value!=0){
		var xml = new ajax();
		xml.open("GET",base+"siteAdmin/ppa_sub_list/?id="+p.value,true);
		xml.onreadystatechange=function(){
			if (xml.readyState==4){
				$(".subContent").html(xml.responseText);
			}
		}
		xml.send();
	}
}
function ppa_sub_parent(action,id,base){
	//alert(base);
	var deletenow = "deletenow";
	var xml = new ajax();
	if (action=="delete"){
		$("#hiddenMsgbox").html('<div class="title">Confirm Deletion</div><br/><center>Are you sure you want to delete this PPA Subcategory?<br/><input type="submit" class="btn btn-warning" value="Yes" onclick="ppa_sub_parent('+"'"+deletenow+"'"+','+"'"+id+"'"+','+"'"+base+"'"+')"/> <input type="submit" class="btn btn-primary" value="No" onclick="hideMes()"/></center>');
		centering();
	} else {
	xml.open("GET",base+"siteAdmin/SubParent/?id="+id+"&type="+action,true);
	xml.onreadystatechange=function(){
		if (xml.readyState==4){
			$("#hiddenMsgbox").html(xml.responseText);
			centering();
			//alert(action);
			if (action=="deletenow"&&xml.responseText=="Successfully Deleted!"){
				loadPPa_list();
				setTimeout('hideMes()',2000)
			}
		}
	}
	xml.send();
	}
}
function add_fund(base,type,id){
	var xml = new ajax();
		if (type=="add"){
			xml.open("GET",base+"siteAdmin/add_fund/?type="+type,true);
		} else if (type=="saveNow"){
			xml.open("GET",base+"siteAdmin/add_fund/?type="+type+"&f_type="+document.getElementById('type').value+"&name="+document.getElementById('name').value,true);
		} else if (type=="modify"){
			xml.open("GET",base+"siteAdmin/add_fund/?type="+type+"&id="+id,true);
		} else if (type=="saveMod"){
			xml.open("GET",base+"siteAdmin/add_fund/?type="+type+"&f_type="+document.getElementById('type').value+"&name="+document.getElementById('name').value+"&id="+id,true);
		}
		xml.onreadystatechange=function(){
			if (xml.readyState==4){
				if (type=="saveNow"){
					if (xml.responseText=="Successfully Saved."){
						setTimeout('hideMes()',2000);
						redirect(base+"siteAdmin/sys_setup/fund/");
					} else if (xml.responseText!="Successfully Saved.") {
						$(".error-wr").html(xml.responseText);
						$(".error-wr").fadeIn();
					} 
				} else {
					$("#hiddenMsgbox").html(xml.responseText);
					centering();
				}
				
			}
		}
		xml.send();	
}
function showAllotment(class_id,base){

	var xml = new ajax();
	var saroID = document.getElementById('saroID');
	xml.open("GET",base+"client/allotment/?saro="+saroID.value+"&class="+class_id,true);
	xml.onreadystatechange=function(){
		if (xml.readyState==4){
			$("#hiddenMsgbox").html(xml.responseText);
			
			$("#mytreeview").treeview({
					//animated: "fast",
					collapsed: true
				});
			loadTBL(base,class_id);
			centering();
		}
	}
	xml.send();
}

function showPPA(class_id,base){

	var xml = new ajax();
	var id = document.getElementById('id');
	xml.open("GET",base+"client/allotment/?id="+id.value+"&class="+class_id,true);
	xml.onreadystatechange=function(){
		if (xml.readyState==4){
			$("#hiddenMsgbox").html(xml.responseText);
			$("#mytreeview").treeview({
					//animated: "fast",
					collapsed: true
				});
			loadTBL(base,class_id);
		}
	}
	xml.send();
}


function search_fund(value,base){
	var xml = new ajax();
	xml.open("GET",base+"siteAdmin/search_fund/?value="+value,true);
	xml.onreadystatechange=function(){
		if (xml.readyState==4){
			$("#fund_list").html(xml.responseText);
		}
	}
	xml.send();
}

function resp_center(base,type,id){

	var xml = new ajax();
	if (type=="addNow"){
		xml.open("GET",base+"siteAdmin/resp_centerControl/?type="+type+"&resp_code="+document.getElementById('resp_code').value+"&resp_desc="+document.getElementById('resp_desc').value,true);
	} else if (type=="edit"){
		xml.open("GET",base+"siteAdmin/resp_centerControl/?type="+type+"&id="+id,true);
	} else if (type=="saveMod"){
		xml.open("GET",base+"siteAdmin/resp_centerControl/?type="+type+"&id="+id+"&resp_code="+document.getElementById('resp_code').value+"&resp_desc="+document.getElementById('resp_desc').value,true);
	} else if (type=="delete"){
		xml.open("GET",base+"siteAdmin/resp_centerControl/?type="+type+"&id="+id,true);
	} else if (type=="deleteNow"){
		xml.open("GET",base+"siteAdmin/resp_centerControl/?type="+type+"&id="+id,true);
	} else {
		xml.open("GET",base+"siteAdmin/resp_centerControl/?type="+type,true);
	}
	xml.onreadystatechange=function(){
		if (xml.readyState==4){
			if (type=="addNow"||type=="saveMod"){
				
				if (xml.responseText!="Successfully Saved!"){
					$(".error-wr").html(xml.responseText);
					$(".error-wr").fadeIn();
				} else {
					redirect(base+"siteAdmin/sys_setup/responsibilityCenter/");
				}
			} else if (type=="deleteNow"&&xml.responseText=="Successfully Removed!"){
				setTimeout(redirect(base+"siteAdmin/sys_setup/responsibilityCenter/"),2000);
			} else {
				$("#hiddenMsgbox").html(xml.responseText);
				centering();
			}
		}
	}
	xml.send();
}

function search_resp(val,base){
	var xml = new ajax();
	xml.open("GET",base+"siteAdmin/search_resp/?val="+val,true);
	xml.onreadystatechange=function(){
		if (xml.readyState==4){
			$("#resp_list").html(xml.responseText);
		}
	}
	xml.send();
}

function exp_control(base,type,id){

	var xml = new ajax();
	if (type=="addNow"){
		xml.open("GET",base+"siteAdmin/exp_control/?type="+type+"&exp_code="+document.getElementById('exp_code').value+"&exp_desc="+document.getElementById('exp_desc').value,true);
	} else if (type=="edit"){
		xml.open("GET",base+"siteAdmin/exp_control/?type="+type+"&id="+id,true);
	} else if (type=="saveMod"){
		xml.open("GET",base+"siteAdmin/exp_control/?type="+type+"&id="+id+"&exp_code="+document.getElementById('exp_code').value+"&exp_desc="+document.getElementById('exp_desc').value,true);
	} else if (type=="delete"){
		xml.open("GET",base+"siteAdmin/exp_control/?type="+type+"&id="+id,true);
	} else if (type=="deleteNow"){
		xml.open("GET",base+"siteAdmin/exp_control/?type="+type+"&id="+id,true);
	} else {
		xml.open("GET",base+"siteAdmin/exp_control/?type="+type,true);
	}
	xml.onreadystatechange=function(){
		if (xml.readyState==4){
			if (type=="addNow"||type=="saveMod"){
				
				if (xml.responseText!="Successfully Saved!"){
					$(".error-wr").html(xml.responseText);
					$(".error-wr").fadeIn();
				} else {
					redirect(base+"siteAdmin/sys_setup/expenditures/");
				}
			} else if (type=="deleteNow"&&xml.responseText=="Successfully Removed!"){
				setTimeout(redirect(base+"siteAdmin/sys_setup/expenditures/"),2000);
			} else {
				$("#hiddenMsgbox").html(xml.responseText);
				centering();
			}
		}
	}
	xml.send();
}
function search_exp(val,base){
	var xml = new ajax();
	xml.open("GET",base+"siteAdmin/search_exp/?val="+val,true);
	xml.onreadystatechange=function(){
		if (xml.readyState==4){
			$("#exp_list").html(xml.responseText);
		}
	}
	xml.send();
}

/*CLIENT JS*/
function not_need_control(base,type,id){
	//alert(base+" "+type);
	var xml = new ajax();
	xml.open("GET",base+"client/not_need_controller/?type="+type);
	xml.onreadystatechange=function(){
		if (xml.readyState==4){
			$("#saro_wrapper").html(xml.responseText);
		}
	}
	xml.send();
}
function setActive(id){
	var last = document.getElementById('last');
	if (last.value!=""){
		if (last.value!=id){
		document.getElementById(last.value).setAttribute("class","");
		}
	}
	document.getElementById(id).setAttribute("class","active");
	last.value = id;
}


function saro_control(base,type,id){
	var xml = new ajax();
	xml.open("GET",base+"client/saro_controller/?type="+type);
	xml.onreadystatechange=function(){
		if (xml.readyState==4){
			//alert(xml.responseText);
			$("#saro_wrapper").html(xml.responseText);
		}
	}
	xml.send();
}
function setActive(id){
	var last = document.getElementById('last');
	if (last.value!=""){
		if (last.value!=id){
		document.getElementById(last.value).setAttribute("class","");
		}
	}
	document.getElementById(id).setAttribute("class","active");
	last.value = id;
}

function load_ppa(base){
	$.ajax({
		url:base+"client/load_ppa/",
		success:function(data){
			$(".subPopup").html(data);
			$(".subPopup").lightbox_me({centered:true});
			$(".subPopup").draggable();
			$("#tview").treeview({
					animated: "fast",
					collapsed: true,
					unique:true
				});
		}
	});
}
function ppa_select(child_id,parent_id,theval){
	$("#real_ppa").val(parent_id+"/"+child_id);
	$("#ppa").val(theval);
	return false;
}
function expends(base){
	$.ajax({
		url:base+"client/expends_list/",
		success:function(data){
			$(".subPopup").html(data);
			$(".subPopup").lightbox_me({centered:true});
			$(".subPopup").draggable();
			$("#tview").treeview({
					animated: "fast",
					collapsed: true,
					unique:true
				});
		}		
	});
}

function exp_select(id,value){
	$("#exp").val(value);
	$("#real_exp").val(id);
}
function auto_(value){
	$("#my_total").val() !="" ? $("#t_output").val(parseInt($("#my_total").val())+parseInt(value)) : $("#t_output").val(value) 
}
function ppa_detail(base,class_id){

	$.ajax({
		url:base+"client/ppa_detail/?saro="+$("#saroID").val()+"&ppa="+$("#real_ppa").val()+"&ppaCode="+$("#ppa").val()+"&resp_center="+$("#resp_center").val()+"&exp="+$("#real_exp").val()+"&expval="+$("#exp").val()+"&amt="+$("#amt").val()+"&class_id="+class_id,
		success:function(data){
			$("#tbody").html(data);
			if ($("#status").val()=="true"){
				$("#real_ppa").val("");
				$("#ppa").val("");
				$("#exp").val("");
				$("#expval").val("");
				$("#amt").val("");
			} else {
				$(".subPopup").html($("#status").val());
				$(".subPopup").lightbox_me({centered:true});
				$(".subPopup").draggable();
			}
				centering();
		},
		error:function(data){
			$("#tbody").html(data);
		}
	});
}

function save_saro(base){
	if ($("#saroID").val()==""||$("#saroID").val()=="SARO"){
		alert("Please Input your saro transaction ID!");
	} else if ($("#d_date").val()==""){
		alert("Please Select a Date!");
	} else if ($("#t_date").val()==""){
		alert("Please properly Select your transaction date!");
	} else if ($("#purpose").val()==""){
		alert("Please specify your purpose!");
	} else {
		
		$.ajax({
			url:base+"client/save_saro/?saroid="+$("#saroID").val()+"&d_date="+$("#d_date").val()+"&t_date="+$("#t_date").val()+"&fund="+$("#fund").val()+"&l_basis="+$("#l_basis").val()+"&purpose="+$("#purpose").val(),
			success:function(data){
				$("#hiddenMsgbox").html(data+"<br/><button class='btn btn-primary' onclick='hideMes()'><i class='icon-white icon-ok'></i> Okay</button>");
				centering();
				if (data=="Successfully Saved!"){
					document.getElementById('saroID').setAttribute("readonly","true");
				}
			}
		});
	//alert("client/save_saro/?saroid="+$("#saroID").val()+"&d_date="+$("#d_date").val()+"&t_date="+$("#t_date").val()+"&fund="+$("#fund").val()+"&l_basis="+$("#l_basis").val()+"&purpose="+$("#purpose").val());
	}
}

function save_nnc(base){
	if ($("#n_date").val()==""){
		alert("Please Select a Transaction Date!");
	} else if ($("#fund").val()==""){
		alert("Please properly Select your fund basis!");
	} else if ($("#l_basis").val()==""){
		alert("Please specify your legal basis!");
	} else {
		
		$.ajax({ 
			url:base+"client/save_nnc/?n_date="+$("#n_date").val()+"&fund="+$("#fund").val()+"&l_basis="+$("#l_basis").val(),
			success:function(data){
				$("#hiddenMsgbox").html(data+"<br/><button class='btn btn-primary' onclick='hideMes()'><i class='icon-white icon-ok'></i> Okay</button>");
				centering();
				// if (data=="Successfully Saved!"){
				// 	document.getElementById('n_date').setAttribute("readonly","true");
				// }
			}
		});
	//alert("client/save_saro/?saroid="+$("#saroID").val()+"&d_date="+$("#d_date").val()+"&t_date="+$("#t_date").val()+"&fund="+$("#fund").val()+"&l_basis="+$("#l_basis").val()+"&purpose="+$("#purpose").val());
	}
}

function del_allotment(base,id,class_id){
	$.ajax({
		url:base+"client/del_allotment/?id="+id,
		success:function(data){
			$(".subPopup").html(data);
			$(".subPopup").lightbox_me({centered:true});
			setTimeout('$(".subPopup").trigger("close")',2000);
			loadTBL(base,class_id);
		}
	});
}

function del_saro(base,id,class_id){
	alert(id);
	$.ajax({
		url:base+"client/del_saro/?id="+id,
		success:function(data){
			$("#hiddenMsgbox").html(data);
				centering();
			if (data=="Successfully Removed!"){
				setTimeout('hideMes()',800);
			loadTBL(base,class_id);
			}
		}
	});
}

function del_nnc(base,id,class_id){
	$.ajax({
		url:base+"client/del_nnc/?id="+id,
		success:function(data){
			$("#hiddenMsgbox").html(data);
			centering();
			loadTBL(base,class_id);
			if (data=="Successfully Removed!"){
				setTimeout('hideMes()',800);
			}
		}
	});
}

function loadTBL(base,class_id){
	$.ajax({
		url:base+"client/load_allotment/?saro="+$("#saroID").val()+"&class_id="+class_id,
		success:function(data){
			$("#tbody").html(data);
			centering();
		}
	});
}

function allotment_reload(base){
	$.ajax({
		url:base+"client/a_reload/?saro="+$("#saroID").val(),
		success:function(data){
			$("#allotment_load").html(data);
		}
	});
}