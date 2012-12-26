<div class="navbar left">
<div class="navbar-inner span9 left">
<br/>
	<div class="navbar-inner" style="height:40px;">
		<ul class="nav">
		<li style="width:285px;"><input type="submit" value="Add New" onclick="exp_control('<?php echo $base_url; ?>','add')" class="btn btn-primary left"/></li>
		<li><form onsubmit="return false" class="form-search pull-right" style="margin-top:5px;">
				<div class="input-append">
					<input type="search" class="span4 search-query" placeholder="Search Here..." onkeyup="search_exp(this.value,'<?php echo $base_url; ?>')"/>
					<button type="submit" style="height:30px;" class="btn"><i class="icon-search"></i></button>
				</div>
			</form></li>
		<ul>
	</div><br/><div id="exp_list">