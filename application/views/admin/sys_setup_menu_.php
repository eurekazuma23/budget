<div class="navbar btn-group-vertical left" style="margin-left:0;width:200px;">
	<div class="navbar-inner">
	<ul class="nav nav-pills" style="margin-bottom:10px;margin-top:10px;">
		<?php
		$mx = array("app_ref","ppa","templates","src_docs","fund","responsibilityCenter","expenditures");
		$text = array("Appropriation References","Programs, Projects and Activities","Templates","Source Documents","Funds","Responsibility Center","Object of Expenditures");
		
		$m = 0;
		while ($m<=count($mx)-1){
			if ($tag!=""){
			if ($mx[$m]==$tag){
				$class = "class='active'";//"class='active-bdy-list' style='font-weight:bold;'";
			} else {
				$class = "";
			}
		}
		?>
		<li <?php echo $class; ?>><a href="<?php echo $base_url."siteAdmin/sys_setup/".$mx[$m]."/"; ?>"><?php echo $text[$m]; ?></a></li>
		<?php $m++; } ?>
	</ul>
	</div>
</div>
