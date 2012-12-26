<div class="body">
	<ul>
		<?php
		$mx = array("needingClearance","saro");
		$text = array("Needing Clearance","Special Allotment");
		
		$m = 0;
		while ($m<=count($mx)-1){
			if ($tag!=""){
			if ($mx[$m]==$tag){
				$class = "class='active-bdy-list'";
			} else {
				$class = "";
			}
		}
		?>
		<a href="<?php echo $base_url."client/trans/".$mx[$m]."/"; ?>"><li <?php echo $class; ?>><?php echo $text[$m]; ?></li></a>
		<?php $m++; } ?>
	</ul>
</div>