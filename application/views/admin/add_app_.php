<br/><table class="table table-striped">
	<tr>
		<th style="width:20%;">Legal Basis</th>
		<td colspan="3"><input type="text" id="legal" style="height:30px;" class="textbox span8"/></td>
	</tr>
	<tr>
		<th>Year</th>
		<td><input type="text" readonly="readonly" class="textbox left" id="yr" value="<?php echo date('Y'); ?>" style="margin-top:-5px;height:50px;"/>
			<button onclick="yr_nav('add')" style="height:25px;margin-top:-5px;float:left;"><i class="icon-chevron-up"></i></button>
			<button onclick="yr_nav('minus')" style="height:25px;margin-left:-29px;margin-top:20px;float:left;"><i class="icon-chevron-down"></i></button>
		</td>
		<th>Span in Years</th>
		<td><input type="text" id="span" style="height:30px;" class="textbox"/></td>
	</tr>
</table>
<table class="table" style="margin-top:20px;">
	<tr>
		<th colspan="4" style="padding-right:20px;">Appropriation Type<th>
	</tr>
	<tr>
		<td colspan="4">
			<center>
			<input type="submit" onclick="app_type(this.id)" class="btn btn-primary curve-left" value="Current" id="curr"/><input type="submit" onclick="app_type(this.id)" class="btn btn-primary curve-right" id="cont" value="Continuing"/>
			</center>
			<input type="hidden" id="c_sel"/>
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
</table>
<center>
	<input type="submit" value="Save Entry" onclick="check_add_app('<?php echo $base_url; ?>');" class="btn btn-primary"/>
</center>
	<br/>