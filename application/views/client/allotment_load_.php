<table class="table table-bordered table-hover table-striped">
			<thead>
			<th>Allotment Class</th>
			<th style="width:150px;">P.P.A. Details</th>
			</thead>
			<?php
				$def = array('Sample1','Sample2','Sample3','Sample4');
				$x = 0;
				$id = 1;
				foreach ($def as $df){
					$cnt = count($list)-1;
					for ($x =0; $x<=$cnt;$x++){
						if ($list[$x]->class_id==$id){
							$color = "btn-primary";
							$class = "icon-ok";
							break;
						} else {
							if ($x==$cnt){
								$class = "icon-remove";
								$color = "btn-danger";
							}
						}
					}
			?>
			<tr>
				<td><?php echo $df; ?>a</td>
				<td><div id="c_loader">
				<button class="btn <?php echo $color; ?>" onclick="showAllotment('<?=$id?>','<?php echo $base_url; ?>')"><i class="icon-white <?php echo $class; ?>"></i></button>
			</div></td>
		</tr>
	<?php $x++; $id++; } ?>
</table>