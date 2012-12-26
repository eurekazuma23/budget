<html>
	<title><?php echo $title; ?></title>
	<head>
		<link rel="stylesheet" type="text/css" href="<?php echo $base_url."public/style/bootstrap.css"; ?>"/>
		<link rel="stylesheet" type="text/css" href="<?php echo $base_url."public/style/default.css"; ?>"/>
		<link rel="stylesheet" type="text/css" href="<?php echo $base_url."public/style/jquery.jscrollpane.css"; ?>"/>
		<link rel="stylesheet" type="text/css" href="<?php echo $base_url."public/style/jquery-ui.css"; ?>"/>
		<link rel="stylesheet" type="text/css" href="<?php echo $base_url."public/style/bootstrap-responsive.css"; ?>"/>
		<link rel="stylesheet" type="text/css" href="<?php echo $base_url."public/style/jquery.treeview.css"; ?>"/>

		<script type="text/javascript" src="<?php echo $base_url; ?>public/script/jquery-1.8.2.js"></script>
		<script type="text/javascript" src="<?php echo $base_url; ?>public/script/jquery-ui.js"></script>
		<script type="text/javascript" src="<?php echo $base_url; ?>public/script/jquery.jscrollpane.js"></script>
		<script type="text/javascript" src="<?php echo $base_url; ?>public/script/default.js"></script>
		<script type="text/javascript" src="<?php echo $base_url; ?>public/script/jquery.easing.1.3.js"></script>

		<script type="text/javascript" src="<?php echo $base_url; ?>public/script/jquery.treeview.js"></script>
		<script type="text/javascript" src="<?php echo $base_url; ?>public/script/jquery.treeview.async.js"></script>
		<script type="text/javascript" src="<?php echo $base_url; ?>public/script/jquery.treeview.edit.js"></script>
		<script type="text/javascript" src="<?php echo $base_url; ?>public/script/jquery.treeview.sortable.js"></script>
		<script type="text/javascript" src="<?php echo $base_url; ?>public/script/bootstrap.js"></script>
		<script type="text/javascript" src="<?php echo $base_url; ?>public/script/bootstrap-collapse.js"></script>
		<script type="text/javascript" src="<?php echo $base_url; ?>public/script/jquery.lightbox_me.js"></script>
		
		<script type="text/javascript">
			$(document).ready(function(){
				$("#mytreeview").treeview({
					//animated: "fast",
					collapsed: false
				});
			});
		</script>
	</head>
	<body onload="center('lgn')">
		<div id="overall"></div>
		<div class="subPopup"></div>
		<div id="hiddenMsgbox"><center><img src="<?php echo $base_url; ?>public/images/loading.gif" style="20px;height:20px;" /><br/>Loading Please Wait...</center></div>
		