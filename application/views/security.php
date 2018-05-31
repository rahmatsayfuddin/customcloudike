
<div class="col-md-12">
	<h2 >Security</h2>
	<div class="row">
		<div class="col-md-2">Login alias</div>
		<div class="col-md-6">
			Allow login with following emails and phone numbers:
			<?php 
			$data_user=$this->get_account->get();
			$basic_auth='';

			foreach ($data_user['logins'] as $login): 
				$arr = explode(":", $login);
				$key = $arr[0];
				$value = $arr[1];
				?>

				<div class="input-group">
					<span class="input-group-addon"><?php echo $key ?></span>
					<input id="msg" type="text" class="form-control" name="msg" value="<?php echo $value?>" readonly>
				</div>
				<br>
			<?php endforeach ?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-2">Web Dav</div>
		<div class="col-md-6">
			<div class="form-group">
				<input id="toggle-one" checked type="checkbox" >
				<script>
					$(function() {
						$(function() {
							$('#toggle-one').bootstrapToggle('off');


						})


					})
				</script>
			</div>
			<?php if (isset($data['login'])): 
				$basic_auth=$data['login'];
				?>
				<script>
					$(function() {
						$(function() {
							$('#toggle-one').bootstrapToggle('on');
						})
					})
				</script>
				<div class="form-group">
					<label for="url">Url :</label>
					<input type="text" class="form-control" id="url" value="https://webdav.cloudike.com" readonly>
				</div>
				<div class="form-group">
					<label for="login">Login :</label>
					<input type="text" class="form-control" id="login" value="<?php echo $data['login'] ?>" readonly>
				</div>
				<div class="form-group">
					<label for="pwd">Password:</label>
					<input type="text" class="form-control" id="pwd" value="<?php echo $data['password'] ?>" readonly>
				</div>
			<?php endif ?>
		</div>
	</div>


</div>

<script type="text/javascript">
	$(window).bind("load", function() {
		$('#toggle-one').change(function() {
			if ($(this).prop('checked')) {

				window.location.href = '<?php echo site_url()?>/users/create_basic_auth';

				
			}
			else{
				
				window.location.href = '<?php echo site_url()."/users/remove_login/".urlencode(rtrim(base64_encode('basic:'.$basic_auth))) ?>';


			}

		})
	});
	
	
</script>

<style type="text/css">
input:-moz-read-only { /* For Firefox */
	background-color: #D6DBE3 !important;
	color: #262A33 !important;
}
input:read-only { 
	background-color: #D6DBE3 !important;
	color: #262A33 !important;
}
</style>