<div class="mid-content curve">
	<span class="mid-content-title"><?php echo $c_title; ?></span>
	<div class="content">
		<div class="tview treeview">
			<div class="flexControls">
				<table>
				<th><a href="javascript:void()" onclick="ppa_action('add','<?php echo $base_url; ?>')">Add</a></th>
				<th><a href="javascript:void()">Edit</a></th>
				<th><a href="javascript:void()">Delete</a></th>
				</table>
			</div>
			<a id="0" href="javascript:void()" value="parent" class="ppa_c" onclick="parent_activ('parent',this.id)">PPA Categories</a><br/>
				<ul id="mytreeview" class="filetree">
					<?php
						if (count($ppa_list)>=1){
							for ($px = 0; $px<=count($ppa_list)-1;$px++){
						//child container
						$child = $ppa_child[$ppa_list[$px]->ppaID]['results'];
						if (count($child)>=1){
							$test = "child_".$ppa_list[$px]->ppaID; 
							$ch = "true"; } else { $ch="false"; $onclick=""; $test="";}
						?>
							<li><span class="folder" style="margin-left:1px;margin-top:8px;"><a id="<?php echo $ppa_list[$px]->ppaID; ?>" href="javascript:void();" value="child" onclick="parent_activ('child',this.id)" style="padding-left:5px;"><?php echo $ppa_list[$px]->ppa_code.".".$ppa_list[$px]->desc; ?></a></span>
							<?php if ($ch =="true"){ ?>
								<ul id="" class="filetree" id="<?php echo $test; ?>" style="display:none;margin-top:-14px;">
									<?php for ($ch =0;$ch<=count($child)-1;$ch++){ ?>
									<li><span class="folder" style="margin-left:1px;margin-top:8px;"><a style="padding-left:4px;" href="javascript:void()"><?php echo $ppa_list[$px]->ppa_code.".".$child[$ch]->childCode.".".$child[$ch]->description; ?></a></span></li>
									<?php } ?>
								</ul>
							<?php } ?>
						</li>
					<?php } } else { ?>
						<li></i>No records yet.<i></li>
					<?php } ?>
				</ul>
			<input type="hidden" id="parent" value="0"/>
			<input type="hidden" id="child" value=""/>
			<input type="hidden" id="subchild" value=""/>
			<input type="hidden" id="tree_last" value="0"/><!--/LAST SELECTED PARENT NODE/-->
			<input type="hidden" id="url" value="<?php echo $base_url; ?>"/>
		</div>
		<div class="subContent"></div>
	</div>
</div>