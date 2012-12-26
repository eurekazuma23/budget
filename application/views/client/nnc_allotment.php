<div class="title">Allotment Class Details
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
			<input type="text" style="height:35px; text-align:right;" id="amt" onkeyup="auto_(this.value)" class="span2" placeholder="0.00"/>
		</td>
	</tr>
<center>
	<button class="btn btn-primary" onclick="hideMes();allotment_reload('<?=$base_url?>')"><i class="icon-white icon-ok"></i> OK</button>
	<button class="btn btn-warning" onclick="hideMes();allotment_reload('<?=$base_url?>')"><i class="icon-white icon-remove"></i> Cancel</button>
</center>