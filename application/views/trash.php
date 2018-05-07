<?php $content=$list['content'];?>
<!-- PAGE CONTENT -->
<div class="page-content" style="background: #FFFFFF">
	<?php $this->load->view('template/nav')?>

	<!-- PAGE CONTENT WRAPPER -->
	<div class="page-content-wrap">       


		<div class="row">
			<!-- breadcrumb --> 
			<div class="breadcrumb" style="margin-bottom: 0">

				<div class="col-sm-12">
					<div class="col-md-6">

						<!-- START BREADCRUMB -->
						<ul class="breadcrumb">
							<li><a href="<?php echo site_url().'/trash'?>">Trash</a></li>           
						</ul>
						<!-- END BREADCRUMB -->  

					</div>

					<div class="col-md-6">
						<div class="col-md-6">
							<button type="button" class=" btn btn-rounded btn-info" id="restore" onclick="restore()">
								<i class="fa fa-undo" aria-hidden="true"></i>
								Restore
							</button>
							<button type="button" class=" btn btn-rounded btn-info" id="empty_trash" data-toggle="modal" data-target="#empty_trash_modal">
								<i class="fa fa-times-circle-o"></i>
								Empty Trash
							</button>
						</div>
					</div>
				</div>
			</div>

			<!-- END breadcrumb -->              


			<?php if (isset($_SESSION['message'])): ?>
				<div class="alert alert-<?php echo $_SESSION['message_type'] ?>" role="alert">
					<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
					<?php echo $_SESSION['message']?>
				</div>
			<?php endif ?>

			<?php if (isset($list['content'])): ?>
				<table class="table table-hover">
					<thead>
						<tr>
							<th width="3%"></th>
							<th width="5%">
								<center>
									<input type="checkbox" id="check_all" onchange="check_all(this)" />
								</center>
							</th>
							<th >Nama</th>
							<th>Ukuran</th>
							<th>Deleted</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php  
						usort ($list['content'] , function ($left, $right) {
							return $right['folder']-$left['folder'];
						});
						?>
						<?php foreach ( $list['content'] as $list): $exploded = explode('/', $list['restore_path']);  ?>

							<tr>
								<td></td>
								<td>  
									<input type="checkbox" id="<?php echo  $list['restore_path'] ?>" name="cb_file[]" class='cb' onclick="count_checkbox()" value="<?php echo  end($exploded) ?>"/>
									<label for="<?php echo  $list['restore_path'] ?>">
										<?php if ($list['folder']): ?>
											<i class="fa fa-folder "></i>
										<?php else: ?>
											<i class="fa <?php echo $controller->icon($list['mime_type']);?>"></i>
										<?php endif ?>
									</label>
								</td>
								<td style="vertical-align:middle;">
									<?php
									
									if ($list['folder']) {
										echo "<a href='".site_url().'/home?path='.$list['restore_path']."'>".end($exploded)." </a>";
									}
									else{
										echo end($exploded);  
									}


									?>

								</td>
								<td style="vertical-align:middle;"><?php echo byte_format($list['bytes']) ?></td>
								<td style="vertical-align:middle;">
									<?php echo $controller->time2str(substr($list['modified'],0,10))  ?> </td>
									<td style="vertical-align:middle;">
										<?php if ($list['folder']): ?>
											<?php if ($list['shared']): ?>
												<i class="fa fa-users fa-2x" data-toggle="tooltip" data-placement="top" title="Shared to others"></i>
											<?php endif ?>
										<?php endif ?>
									</td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
					<?php if (empty($content)): ?>
						<div class="col-md-12">

							<div class="error-container">
								<div class="error-code">
									<i class="fa fa-cloud-upload"></i>
								</div>
								<div class="error-text">Folder is Empty</div>
								<div class="error-subtext">
								Upload some files</div>

							</div>

						</div>
					<?php endif ?>
				<?php else: ?>
					<div class="col-md-12">

						<div class="error-container">
							<div class="error-code">404</div>
							<div class="error-text">page not found</div>
							<div class="error-subtext">Unfortunately we're having trouble loading the page you are looking for. Please wait a moment and try again or use action below.</div>
							<div class="error-actions">                                
								<div class="row">
									<div class="col-md-6">
										<button class="btn btn-info btn-block btn-lg" onclick="document.location.href = '<?php  echo site_url()?>/home';">Back to My files</button>
									</div>
									<div class="col-md-6">
										<button class="btn btn-primary btn-block btn-lg" onclick="history.back();">Previous page</button>
									</div>
								</div>                                
							</div>

						</div>

					</div>
				<?php endif ?>


			</div>




		</div>
		<!-- END PAGE CONTENT WRAPPER -->                                
	</div>            
	<!-- END PAGE CONTENT -->

	<div class="modal" id="empty_trash_modal" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title" id="defModalHead">Konfirmasi Hapus</h4>
				</div>
				<div class="modal-body">
					<h2>Apakah anda yakin untuk menghapus ?</h2>
					<a href=""  data-dismiss="modal" class="btn btn-warning">Tidak</a>
					<a href="<?php echo site_url()?>/trash/empty_trash" class="btn btn-success" id="link-multy-delete">Ya</a>
				</div>
			</div>
		</div>
	</div>

	<style type="text/css">
	.errspan {
		float: right;
		margin-right: 6px;
		margin-top: -20px;
		position: relative;
		z-index: 2;
		color: red;
	}
</style>
<script >

	function restore() {
		var checkedValue = $('.cb:checked').val();
		var values = $('input:checkbox:checked.cb').map(function () {
			return this.value;
		}).get();
		var myData = { "path[]": values} ;
    //console.log(jQuery.param(myData));
    location.href = "<?php echo site_url() ?>/trash/restore?"+jQuery.param(myData);
    //$.get( "<?php echo site_url() ?>/home/multiple_download", { "path[]": values} );
}
$(document).ready(function(){
	$("#restore").prop('disabled', true);
	var $checkboxes = $('.cb');
	var countCheckedCheckboxes = $checkboxes.length;

	if (countCheckedCheckboxes<1) {
		$("#empty_trash").prop('disabled', true);
	}
});
function count_checkbox() {
	var $checkboxes = $('.cb');
	var countCheckedCheckboxes = $checkboxes.filter(':checked').length;
	if ($checkboxes.length!=countCheckedCheckboxes)
	{  
      //$('#check_all').iCheck('uncheck');
      document.getElementById("check_all").checked = false;
  }
  else{
      //$('#check_all').iCheck('check');
      document.getElementById("check_all").checked = true;
  }

  if (countCheckedCheckboxes>0) {
  	$("#restore").prop('disabled', false);
  }
  else{
  	$("#restore").prop('disabled', true);
  }
  console.log(countCheckedCheckboxes);
}
</script>
<script type="text/javascript">
  // $("#check_all").on("ifChecked", check_all);
  function check_all($this) { 
    //$('.cb').prop('checked', true);
    //console.log($this.checked);
    $('input:checkbox').not(this).prop('checked', $this.checked);
    count_checkbox() 
}
</script>
<script type="text/javascript">
	function copy_clipboard() {
		var copyText = document.getElementById("link");
		copyText.select();
		document.execCommand("Copy");
	}
	function others_copy_clipboard() {
		var copyText = document.getElementById("others_link");
		copyText.select();
		document.execCommand("Copy");
	}
</script>
