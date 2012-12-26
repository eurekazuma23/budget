<div class="navbar left">
<div class="navbar-inner span9 left">
<br/>
	<div class="navbar-inner" style="height:40px;">
		<ul class="nav nav-pills">
		<li id="add"><a href="javascript:void();" id="add" 
			onclick="saro_control('<?php echo $base_url; ?>','add');
			setActive(this.id)">Add New</a></li>
		<li id="records"><a href="javascript:void()" id="records"
		 onclick="saro_control('<?php echo $base_url; ?>','records');
		 setActive(this.id)">Records</a></li>
		<li style="margin-left:100px;">
			<form onsubmit="return false" class="form-search pull-right" style="margin-top:5px;">
				<div class="input-append">
					<input type="search" class="span4 search-query" placeholder="Search Here..." 
					onkeyup="search_resp(this.value,'<?php echo $base_url; ?>')"/>
					<button type="submit" style="height:30px;" 
					class="btn"><i class="icon-search"></i></button>
				</div>
			</form></li>
		<ul>
		<input type="hidden" id="last"/>
	</div><br/><div id="saro_wrapper">Select Your Actions</div><br/>
