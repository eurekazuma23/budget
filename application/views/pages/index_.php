<div id="lgn" class="login_wr curve">

	<?php
		if (isset($_POST['user'])&&isset($_POST['pass'])){
			$user = $_POST['user'];
			$pass = $_POST['pass'];
			
			if (isset($auth)){
				?>
				<div class="error-wr"><?php echo $auth; ?></div>
				<?php
			}
		} else {
			$user = "";
			$pass = "";
		}
	?>
	<form action="<?php echo $base_url; ?>coa/login/" method="post">
	<table class="width100" style="margin-left:-13px;margin-top:50px;">
		<tr>
			<th class="curve-right" style="width:20%;padding-left:10px;">Username</th>
			<td style="padding-left:20px;"><input type="text" style="height:35px;" class="textbox width100" id="user" placeholder="Your username" onclick="tooltip(this.id)" name="user" value="<?php echo $user; ?>"></td>
		</tr>
		<tr>
			<th class="curve-right" style="width:20%;padding-left:10px;">Password</th>
			<td style="padding-left:20px;"><input type="password" style="height:35px;" class="textbox width100" placeholder="Your Password" name="pass" value="<?php echo $pass; ?>"></td>
		</tr>
	</table><br/>
	<center>
		<input type="submit" name="auth" value="Login" class="btn btn-primary"/>
	</center>
	</form>
</div>