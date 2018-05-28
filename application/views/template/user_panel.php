<div class="page-content" style="background: #FFFFFF">
	<?php $this->load->view('template/nav')?>

	<!-- PAGE CONTENT WRAPPER -->

	<div class="page-content-wrap">       


		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<ul class="nav navbar-nav">
					<li class="active"><a href="#">Account</a></li>
					<li><a href="#">Detail</a></li>
					<li><a href="#">Security</a></li>
					<li><a href="#">Contact</a></li>
					<li><a href="#">Activity Log</a></li>
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