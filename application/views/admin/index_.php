<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner">
	
	<ul class="nav">
		<li><a href="<?php echo $base_url."siteAdmin/" ?>"><i class="icon-white icon-home"></i></a></li>
		<?php
		
			for($x=0;$x<=count($mnu)-1;$x++){
		?>
			<li><a href="<?php echo $base_url."siteAdmin/".$mnu[$x]['link'] ?>"><?php echo $mnu[$x]['text']; ?></a></li>
		<?php } ?>
	</ul>
</div>
</div><br/><br/>
<div class="row-fluid navbar navbar-inner">
	<ul class="nav">
		<?php for($m =0; $m<=count($map)-1;$m++) { 
			$keys = array_keys($map);
			if ($active==$keys[$m]){
				$class = "display:none";
			} else {
				$class = "";
			}
		?>
			<li><a href="<?php echo $map[$keys[$m]]; ?>"><?php echo $keys[$m]; ?></a></li><div class="sep" style="<?php echo $class; ?>"></div>
		<?php } ?>
	</ul>
</div>
