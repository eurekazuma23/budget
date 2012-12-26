<html>
	<head>
		<link rel="stylesheet" type="text/css" href="ppadet.css">
		<link rel="stylesheet" type="text/css" href="g-buttons.css"/>
	</head>
	<body>
		<div class="oall"><br/>
		<div class="hed1">
			P.P.A Code <input type="text" readonly="readonly" name="ppad" value="" style="width:300px;">
		</div>
		<div class="hed2">	
			Allocated Amount: <input type="text" readonly="readonly" name="aa" value="" style="width:280px;">
		</div>
		<div class="hed2"><br/>
			Remaining Amount: <input type="text" readonly="readonly" name="ra" value="" style="width:276px;">
		</div><br/><br/><br/><br/>
		<hr>
		<div class="data-table" cellspacing="0">
		<table style="width:850;">
			<th> </th>
			<th> Responsibility Center </th>
			<th> Object of Expenditure </th>
			<th> Amount </th>
			<th> Action </th>
			<tr class="yellow" align="center">
			<td> 1 </td>
			<td> <select style="width:200px;">
				<option></option>
				<option> A. Highway Project	</option>
				<option> B. Office Supplies </option>
				<option> C. Development		</option>
				<option> D. Maintenance	    </option>
			</td>
			<td> <select style="width:200px;">
					<option> </option>			
				</td>
			<td>Php <input type="text" name="oamt" value="" style="width:200px;">	
			</td>
			<td>	<button class="g-button green">CLEAR<i class="icon-white icon-refresh"></i></button> </td>
			</tr>
		</table>
		<button class="g-button white">ADD LINE<i class="icon-white icon-plus-sign" onclick=""></i></button>
		</div><br/>
		<hr>
		<div id="tot">
		 Total: <input type="text" readonly="readonly" name="tot"  id="tot" value="" style="width:200px;">
		</div>
		<div class="ab">
			<button class="g-button green">NEW<i class="icon-white icon-file"></i></button>
			<button class="g-button green">SAVE<i class="icon-white icon-ok"></i></button>
			<button class="g-button green">DELETE<i class="icon-white icon-trash"></i></button>
			<button class="g-button green">CANCEL<i class="icon-white icon-remove"></i></button>
			<button class="g-button green">IMPORT<i class="icon-white icon-download-alt"></i></button>
		</div>
		<hr><br>
	</div>
	</body>
</html> 
<?php
	class detobj{

		public function gppaamt(){
			$amt=$_GET['amt'];
			$ppa=$_GET['ppa'];

			$tot= -$oamt;
			
			}

	}
?>