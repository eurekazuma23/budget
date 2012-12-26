		<table class="table">
			<tr>
				<th style="width:10%;">Transaction No.</th>
				<td style="width:25%;"><input type="text" style="height:35px;" id="saroID" value="SARO" class="textbox width200 italic underline"/></td>
				<th style="width:10%;">Date</th>
				<td style="width:25%;"><input type="text" style="height:35px;" id="d_date" onmouseover="$(this).datepicker()" class="textbox width200 left"/></td>
			</tr>
			<tr>
				<th>Tran. Date</th>
				<td colspan="3"><input type="text" style="height:35px;" id="t_date" class="textbox width200" onmouseover="$(this).datepicker()"/></td>
				<!--<th style="width:10%;">From Needing Clearance</th>
				<td style="width:25%;"><input type="checkbox" class="textbox width200"/></td>-->
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
			<tr>
				<th>Purpose</th>
				<td colspan="3">
					<input type="text" id="purpose" style="height:35px;" class="textbox width100" />
				</td>
			</tr>
		</table>
		<div id="allotment_load">
		<table class="table table-bordered table-hover table-striped">
			<thead>
			<th>Allotment Class</th>
			<th style="width:150px;">P.P.A. Details</th>
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
					<button class="btn btn-primary" onclick="showAllotment('<?=$id?>','<?php echo $base_url; ?>')"><i class="icon-white icon-remove"></i></button>
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
			<input type="submit" onclick="save_saro('<?=$base_url?>')" class="btn btn-primary large" value="Save"/>
		</center>