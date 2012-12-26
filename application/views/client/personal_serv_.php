<div class="title">Personal Services
</div><br/>

<table class="table table-bordered table-striped table-hover" style="width:800px;">
<thead>	
	<th>P.P.A. Code</th>
	<th>Amount</th>
</thead>
<tbody>
	<tr>
		<td><input type="text" style="height:35px;" readonly="readonly" class="uneditable-input span2 pull-left" id="ppa"/><button class="btn pull-right" style="margin-top:2px;" onclick="load_ppa('<?php echo $base_url; ?>')">...</button></td>
		<td>
		 	<select id="resp_center">
				<?php $rcount = count($resp_center)-1;
					for ($r = 0; $r<=$rcount;$r++){ ?>
		<?php } ?>
			</select>
		</td>
		<td>
			<input type="text" style="height:35px;" readonly="readonly" id="exp" class="span2 pull-left"/><button onclick="expends('<?=$base_url?>')" class="btn pull-right" style="margin-top:2px;">..</button>
		</td>
		<td>
			<input type="text" style="height:35px;" id="amt" onkeyup="auto_(this.value)" class="span2"/>
		</td>
	</tr>
	<tr>
		<td colspan="4"><input type="submit" onclick="ppa_detail('<?=$base_url?>','<?=$classID?>')" class="btn btn-primary pull-left" value="Save Entry"/><span class="right">Total : <input type="text" id="t_output" class="textbox" readonly="readonly" style="height:35px;" value="00.00"/></span></td>
	</tr>
</tbody>
</table>
<div style="max-height:250px;overflow-x:hidden;overflow-y:auto;">
	<div id="tbody"><input type="hidden" id="my_total" /></div>
</div><br/>
<center>
	<button class="btn btn-primary" onclick="hideMes();allotment_reload('<?=$base_url?>')"><i class="icon-white icon-ok"></i> OK</button>
	<button class="btn btn-warning" onclick="hideMes();allotment_reload('<?=$base_url?>')"><i class="icon-white icon-remove"></i> Cancel</button>
</center>
<input type="hidden" id="real_ppa"/>
<input type="hidden" id="real_exp"/>