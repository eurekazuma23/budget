<div class="error-wr">
	There Are error(s) encountered.<br/>
<ul style="text-align:left;margin-left:-10px;">
	<?php
	foreach ($errors as $err){
	?>
	<li><?php echo $err; ?></li>
	<?php } ?>
</ul>
</div><br/><center><input type="submit" value="Okay" onclick="hideMes()" class="g-button blue"></center><br/>
