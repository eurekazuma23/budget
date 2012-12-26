<div class="title">Modify Appropriation Detail</div><br/>
<table class="ord-table extend-table">
	<tr>
		<th style="width:20%;">Legal Basis</th>
		<td colspan="3"><input type="text" style="height:35px" id="legal" value="<?php echo $info[0]->legal_basis; ?>" class="textbox width100" /></td>
	</tr>
	<tr>
		<th>Year</th>
		<td><input type="text" readonly="readonly" class="textbox left" id="yr" style="height:50px;margin-top:-5px;" value="<?php echo $info[0]->year; ?>"/>
			<button onclick="yr_nav('add')" style="height:25px;margin-top:-5px;float:left;"><i class="icon-chevron-up"></i></button>
			<button onclick="yr_nav('minus')" style="height:25px;margin-left:-29px;margin-top:20px;float:left;"><i class="icon-chevron-down"></i></button>
		</td>
		<th>Span in Years</th>
		<td><input type="text" id="span" style="height:35px" class="textbox" value="<?php echo $info[0]->span; ?>"/></td>
	</tr>
</table>
<table class="ord-table hrtop-orange extend-table" style="margin-top:20px;">
	<tr>
		<th colspan="4" style="padding-right:20px;">Appropriation Type<th>
	</tr>
	<tr>
		<td colspan="4">
			<center>
			<input type="submit" onclick="app_type(this.id)" class="btn btn-primary curve-left" value="Current" id="curr"/><input type="submit" onclick="app_type(this.id)" class="btn btn-primary curve-right" id="cont" value="Continuing"/>
			</center>
			<input type="hidden" id="c_sel" value="<?php echo $info[0]->cont; ?>"/>
		</td>
	</tr>
	<tr>
		<td colspan="4"><center>
			<select id="app_type" class="textbox width200">
				<option>Regular</option>
				<option>Special</option>
			</select></center>
		</td>
	</tr>
</table><br/><br/>
<center>
	<input type="submit" value="Save Entry" onclick="check_edit_app('<?php echo $info[0]->id; ?>','<?php echo $base_url; ?>');" class="btn btn-primary" style="margin-top:20px;"/>
	<input type="submit" value="Cancel" onclick="hideMes()" class="btn btn-warning" style="margin-top:20px;"/>
</center><br/><div class="msg"></div>
<div style="display:none" class="error-wr"></div>