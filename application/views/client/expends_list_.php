<div stlye="max-height:150px;overflow:auto;">
<div class="title">Object Of Expenditures</div>
<ul id="tview" class="treeview filetree">
	<?php
		$cnt = count($expends)-1;
		for ($x = 0; $x<=$cnt; $x++){
	?>
	<li><span class="folder">
		<span style="padding-left:5px;">
			<a id="<?php echo $expends[$x]->id; ?>" 
				href="javascript:exp_select
				('<?php echo $expends[$x]->id; ?>','<?=$expends[$x]->code?>')">
				<?=$expends[$x]->code." - ".$expends[$x]->exp_desc?></a></span></span>
	</li>
	<?php } ?>
</ul>
</div>