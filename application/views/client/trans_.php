<div class="navbar btn-groud-vertical left" style="width:200px;">
	<div class="navbar-inner">
	<ul class="nav nav-pills" style="margin-top:10px;margin-bottom:10px;">
		<?php
		$mx = array("NotneedingClearance","needingClearance","saro");
		$text = array("Not Needing Clearance","Needing Clearance","Special Allotment");
		$m = 0;
		while ($m<=count($mx)-1){
			if ($tag!=""){
			if ($mx[$m]==$tag){
				$class = "class='active'";
			} else {
				$class = "";
			}
		}
		?>
		<li <?php echo $class; ?>><a href="<?php echo $base_url."client/transaction/".$mx[$m]."/"; ?>"><?php echo $text[$m]; ?></a></li>
		<?php $m++; } ?>
	</ul>
	</div>
</div>