<div class="page-content" style="background: #FFFFFF">
	<?php $this->load->view('template/nav')?>

	<!-- PAGE CONTENT WRAPPER -->

	<div class="page-content-wrap">       


		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<ul class="nav navbar-nav">
					<li class="<?php if(isset($account)){echo $account;}?>"><a href="<?php echo site_url() ?>/users">Account</a></li>
					<li class="<?php if(isset($detail_account)){echo $detail_account;}?>"><a href="<?php echo site_url() ?>/users/detail">Detail</a></li>
					<li class="<?php if(isset($security)){echo $security;}?>"><a href="<?php echo site_url() ?>/users/security">Security</a></li>
					<li class="<?php if(isset($contact)){echo $contact;}?>"><a href="<?php echo site_url() ?>/users/contact">Contact</a></li>
					<li class="<?php if(isset($log)){echo $log;}?>"><a href="<?php echo site_url() ?>/users/activity_log">Activity Log</a></li>
				</ul>
			</div>
		</nav>

		<?php if (isset($_SESSION['message'])): ?>
			<div class="alert alert-<?php echo $_SESSION['message_type'] ?>" role="alert">
				<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
				<?php echo $_SESSION['message']?>
			</div>
		<?php endif ?>

		<div class="container">

			<div class="row">

				<div class="col-md-12">
					<?php echo $data ?>
				</div>
				


			</div>	
		</div>

	</div>
</div>







</div>
<!-- END PAGE CONTENT WRAPPER -->                                
</div>            
	<!-- END PAGE CONTENT -->