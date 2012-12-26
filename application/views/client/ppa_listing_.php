<div style="max-height:150px;overflow:auto;">
<div class="title">Select PPA</div>
<ul id="tview" class="treeview filetree">
	<?php
		$cnt = count($ppa_list)-1;
		for ($x = 0; $x<=$cnt; $x++){
	?>
	<li><span class="folder"><span style="padding-left:5px;"><a id="<?=$ppa_list[$x]->id?>" href="javascript:ppa_select(this.id,'<?=$ppa_list[$x]->ppaID?>','<?=$ppa_list[$x]->ppa_code?>')"><?=$ppa_list[$x]->ppa_code?></a></span></span>
		<?php
		$child = $ppa_child[$ppa_list[$x]->ppaID]['results'];
			if (count($child)>0){ $ch_count = count($child)-1;
		?>
			<ul class="treeview filetree" style="margin-top:-5px;">
				<?php for ($m =0 ;$m<=$ch_count; $m++){ ?>
				<li><span style="padding-left:5px;"><a id="<?php echo $child[$m]->id; ?>" href="javascript:ppa_select(this.id,'<?=$ppa_list[$x]->ppaID?>','<?=$ppa_list[$x]->ppa_code.".".$child[$m]->childCode?>')"><?php echo $ppa_list[$x]->ppa_code.".".$child[$m]->childCode." ".$child[$m]->description; ?></a></span></li>
				<?php } ?>
			</ul>
		<?php } ?>
	</li>
	<?php } ?>
</ul>
</div>