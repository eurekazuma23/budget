
		<table class="table">
			<tr>
 		<!-- <input type="hidden" name="nnc_trans"  readonly="readonly" value="<?php echo $nnc_trans+1; ?>"/> -->
				<th style="width:10%;">Date</th>
				<td style="width:25%;"><input type="text" style="height:35px;" id="n_date" onmouseover="$(this).datepicker()" class="textbox width200 left"/></td>
			</tr>
			<tr>
				<th>Fund</th>
				<td colspan="3">
					<select class="textbox width100" id="fund">
						<option></option>
						<?php
						$a = array('0'=>'General','1'=>'RA','2'=>'Special');
						$c = count($fund)-1; for ($x=0;$x<=$c;$x++){ ?>
						<option value="<?php echo $fund[$x]->id; ?>"><?php echo $a[$fund[$x]->type]." - ".$fund[$x]->fund_desc; ?></option>
						<?php } ?>
					</select>
				</td> 
			</tr>
			<tr>
				<th>Legal Basis</th>
				<td colspan="3">
					<select class="textbox width100" id="l_basis">
						<option></option>
						<?php $cn = count($legal_basis)-1; 
						for ($c_=1;$c_<=$cn;$c_++){ ?>
						<option value="<?php echo $legal_basis[$c_]->id; ?>"><?php echo $legal_basis[$c_]->legal_basis; ?></option>
						<?php } ?>
					</select>
				</td>
			</tr>

		</table>
		<div id="allotment_load">
		<table class="table table-bordered table-hover table-striped">
			<thead>
			<th style="text-align:center;">Allotment Class</th>
			<th style="width:150px;text-align:center;">P.P.A. Details</th>
			</thead>
			<?php
				$def = array('Personal Services','Maintenance and Other Operating Expenses','Financial Expenses','Capital Outlay');
				$x = 0;
				$id = 1;
				foreach ($def as $df){
			?>
			<tr>
				<td><?php echo $df; ?></td>
				<td><div id="c_loader">
					<center><button class="btn btn-primary" onclick="showPPA('<?=$id?>','<?php echo $base_url; ?>')"><i class="icon-white icon-remove"></i></button></center>
				</div></td>
			</tr>
			<?php $x++; $id++; } ?>
		</table></div><br/>
		<table class="width100" style="text-align:left">
			<tr>
				<th style="width:200px;">Prepared By :</th>
				<td><input type="text" style="height:35px;" value="<?php echo $user[0]->lastname." ,".$user[0]->firstname; ?>" class="textbox width100" readonly="readonly"/></td>
			</tr>
			<tr>
				<th style="width:200px;">Certified Correct By :</th>
				<td><input type="text" style="height:35px;" value="" class="textbox width100" readonly="readonly"/></td>
			</tr>
		</table>
		<center>
			<input type="submit" onclick="save_nnc('<?=$base_url?>')" class="btn btn-primary large" value="Save"/>
		</center>