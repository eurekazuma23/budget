<br/><div class="navbar left">
<div class="navbar-inner span9 left">
<br/>
<div class="navbar-inner" style="margin-left:-10px;width:680px;height:40px;">
	<ul class="nav">	
		<li style="width:310px;"><input type="submit" class="btn btn-primary left" value="Add New" onclick="add_fund('<?php echo $base_url; ?>','add')"/></li>
		<li>		<form onsubmit="return false" class="form-search pull-right" style="margin-top:5px;">
					<div class="input-append">
						<input type="search" onkeyup="search_fund(this.value,'<?php echo $base_url; ?>')" class="span4 search-query" placeholder="Search Here..." onkeyup=""/>
						<button type="submit" style="height:30px;" class="btn"><i class="icon-search"></i></button>
					</div>
				</form></li>
	</ul>
</div><br/><div id="fund_list">