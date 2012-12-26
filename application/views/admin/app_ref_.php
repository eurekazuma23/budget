<br/><div class="navbar span10 left">
<div class="navbar-inner left">
<br/>
	
	<!--<div class="content">-->
		<div class="navbar-inner span9" style="height:30px;margin-left:-4px;margin-bottom:15px;" >
		
		<ul class="nav nav-pills">
			<li id="add_app_list" onclick="getAppRef(this.id,'<?php echo $base_url; ?>')"><a href="javascript:void()">Add New</a></li>
			<li id="view_app_list" onclick="getAppRef(this.id,'<?php echo $base_url; ?>')"><a href="javascript:void()">List</a></li>
		</ul>
		<ul class="hiddenSearch pull-right" style="display:none;margin-top:5px;">
			<li style="display:block">
				<form onsubmit="return false" class="form-search pull-right">
					<div class="input-append">
						<input type="search" class="span4 search-query" placeholder="Search Here..." onkeyup="search_appro(this.value,'<?php echo $base_url; ?>')"/>
						<button type="submit" style="height:30px;" class="btn"><i class="icon-search"></i></button>
					</div>
				</form>
			</li>
		</ul>
		<!--</div>-->
		<input type="hidden" id="last" />
		
</div>
			<div id="tab_content" style="padding-top:20px;">
				Select Your Actions.
			</div>
	</div>
</div>