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
							<li><a href="<?php echo site_url().'/home?path='?>">My Files</a></li>           
						</ul>
						<!-- END BREADCRUMB -->  

					</div>

					<div class="col-md-6">
						<div class="col-md-6">
							<button type="button" class=" btn btn-rounded btn-info" id="multy_download" onclick="multy_download()">
								<i class="fa fa-cloud-download"></i>
								Download
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
							<th></th>
							<th></th>
							<th>Ukuran</th>
							<th>Dimodifikasi</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php  
						usort ($list['content'] , function ($left, $right) {
							return $right['folder']-$left['folder'];
						});
						?>
						<?php foreach ( $list['content'] as $list): ?>

							<tr>
								<td></td>
								<td>  
									<input type="checkbox" id="<?php echo  $list['path'] ?>" name="cb_file[]" class='cb' onclick="count_checkbox()" value="<?php echo  $list['path'] ?>"/>
									<label for="<?php echo  $list['path'] ?>">
										<?php if ($list['folder']): ?>
											<i class="fa fa-folder "></i>
										<?php else: ?>
											<i class="fa <?php echo $controller->icon($list['mime_type']);?>"></i>
										<?php endif ?>
									</label>
								</td>
								<td style="vertical-align:middle;">
									<?php
									$exploded = explode('/', $list['path']);  
									if ($list['folder']) {
										echo "<a href='".site_url().'/home?path='.$list['path']."'>".end($exploded)." </a>";
									}
									else{
										echo end($exploded);  
									}


									?>

								</td>
								<td style="vertical-align:middle;">

									<a href="" data-toggle='modal' data-target='#share' data-hash='<?php echo $list['public_hash']?>' data-path='<?php echo $list['path']?>' data-full='<?php echo json_encode($list) ?>' >
										<?php if (empty($list['public_hash'])): ?>
											<i class="fa fa-share-alt fa-2x"  data-toggle="tooltip" data-placement="top" title="Share"></i>
										<?php else: ?>
											<i class="fa fa-link text-yellow fa-2x"  data-toggle="tooltip" data-placement="top" title="Shared"></i>
										<?php endif ?>
									</a>
								</td>
								<td style="vertical-align:middle;">
									<div class="dropdown">
										<a class="dropdown-toggle" type="button" data-toggle="dropdown">
											<span class="fa fa-ellipsis-h"></span></a>
											<ul class="dropdown-menu">
												<li>
													<a href="#"  data-toggle='modal' data-target='#ubah_nama' data-nama='<?php echo end($exploded);  ?>' data-path='<?php echo $list['path'] ?>'>
														<i class="fa fa-pencil"></i>Ubah Nama</a>
													</li> 
													<li>
														<?php if ($list['folder']): ?>
															<a href="<?php echo site_url().'/home/multiple_download/?path[]='.$list['path'];?>" ><i class="fa fa-cloud-download"></i>Unduh</a>
														<?php else: ?>

															<a href="<?php echo site_url().'/home/download/'.urlencode(rtrim(base64_encode($list['path']),'='));?>" ><i class="fa fa-cloud-download"></i>Unduh</a>
														<?php endif ?>
													</li> 
												</ul>
											</div>
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
											<i class="fa fa-folder-o"></i>
										</div>
										<div class="error-text">You have no public files </div>

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



			<div class="modal" id="share" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true" style="display: none;">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" onclick="location.reload(true);"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
							<ul class="nav nav-tabs">
								<li class="active"><a data-toggle="tab" href="#tab_public_link">Create Public Link </a></li>
								<li><a data-toggle="tab" href="#tab_others_link" id="tab_menu_other">Share with others</a></li>
							</ul>
						</div>
						<div class="modal-body">

							<div class="tab-content">
								<div id="tab_public_link" class="tab-pane fade in active">
									<h3><i class="fa fa-globe"></i> Public Link </h3>
									<div class="form-group">
										<div id="status-area"></div>

										<label for="folder_name">Created link:</label>
										<div class="input-group">
											<input type="text" class="form-control" id='link' placeholder="Public Link is not Created yet" readonly>
											<span class="fa fa-spinner fa-spin errspan" id='share-spinner'></span>
											<span class="input-group-btn">
												<button class="btn btn-default" type="button" id="create_link" onclick="create_link()">Create Link</button>
												<button class="btn btn-default" type="button" id="copy" onclick="copy_clipboard()" data-toggle="popover" data-placement="top" data-content="Copied">Copy to Clipboard</button>
												<button class="btn btn-danger" id="delete_link" data-toggle="tooltip" data-placement="top" title="Delete Link" onclick="delete_link()"><i class="fa fa-trash-o"></i></button>
											</span>
											<input type="hidden" id='share_path'>
										</div>
									</div>
								</div>

								<div id="tab_others_link" class="tab-pane fade">
									<h3><i class="fa fa-users"></i> Share with others </h3>
									<div class="form-group">
										<label for="folder_name">Created link:</label>
										<div class="input-group">
											<input type="text" class="form-control" id='others_link' placeholder="Shared Link is not Created yet" readonly>
											<span class="fa fa-spinner fa-spin errspan" id='others_share-spinner'></span>
											<span class="input-group-btn">
												<button class="btn btn-default" type="button" id="others_create_link" onclick="others_create_link()">Make share Link</button>
												<button class="btn btn-default" type="button" id="others_copy" onclick="others_copy_clipboard()" data-toggle="popover" data-placement="top" data-content="Copied">Copy to Clipboard</button>
												<button class="btn btn-danger" id="others_delete_link" data-toggle="tooltip" data-placement="top" title="Delete Link" onclick="others_delete_link()"><i class="fa fa-trash-o"></i></button>
											</span>
											<input type="hidden" id='others_share_path'>
										</div>
										<br>
										<h3>Who can edit this content ?</h3>

										<h5><i class="fa fa-check-square-o"></i> Me (Owner)</h5>

									</div>
								</div>



							</div>
      <!--   <form action="<?php echo site_url()?>/home/create_folder" method="post">
      -->  
      <!--  </form> -->
  </div>
  <div class="modal-footer">
  	<button type="submit" class="btn btn-warning" onclick="location.reload(true);">Done</button>
  </div>
</div>
</div>
</div>


<div class="modal" id="ubah_nama" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="defModalHead">Ubah Nama</h4>
			</div>
			<div class="modal-body">
				<form action="<?php echo site_url()?>/home/rename" method="post">
					<div class="form-group">
						<label for="folder_name">Nama Baru:</label>
						<input type="text" class="form-control" id="newname" placeholder="folder name" name="newname" >
						<input type="hidden" name="path" id="rename_path">
					</div>
					<button type="submit" class="btn btn-warning">Submit</button>
				</form>
			</div>
		</div>
	</div>
</div>


<div class="modal" id="delete_confirmation" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="defModalHead">Konfirmasi Hapus</h4>
			</div>
			<div class="modal-body">
				<h2>Apakah anda yakin untuk menghapus ?</h2>
				<a href=""  data-dismiss="modal" class="btn btn-warning">Tidak</a>
				<a  class="btn btn-success" id="link-delete">Ya</a>
			</div>
		</div>
	</div>
</div>

<div class="modal" id="multy_delete_confirmation" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="defModalHead">Konfirmasi Hapus</h4>
			</div>
			<div class="modal-body">
				<h2>Apakah anda yakin untuk menghapus ?</h2>
				<a href=""  data-dismiss="modal" class="btn btn-warning">Tidak</a>
				<a  class="btn btn-success" id="link-multy-delete">Ya</a>
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

	function multy_download() {
		var checkedValue = $('.cb:checked').val();
		var values = $('input:checkbox:checked.cb').map(function () {
			return this.value;
		}).get();
		var myData = { "path[]": values} ;
    //console.log(jQuery.param(myData));
    location.href = "<?php echo site_url() ?>/home/multiple_download?"+jQuery.param(myData);
    //$.get( "<?php echo site_url() ?>/home/multiple_download", { "path[]": values} );
}
$(document).ready(function(){
	$("#multy_download").hide();
	$("#multy_delete").hide();
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
  	$("#multy_download").show();
  	$("#multy_delete").show();
  }
  else{
  	$("#multy_download").hide();
  	$("#multy_delete").hide();
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

<script type="text/javascript">
	$('#ubah_nama').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget)
		var $path = button.data('nama') 
		var rename_path = button.data('path') 
		$('#newname').val($path);
		$('#rename_path').val(rename_path);
	})  
</script>

<script type="text/javascript">
	$('#share').on('show.bs.modal', function (event) {
		$("#tab_menu_other").hide();
		$('#share-spinner').hide();
		$('#others_share-spinner').hide();
		$('#link').val('');

		$("#create_link").show();
		$("#copy").hide();
		$("#delete_link").hide();

		$("#others_create_link").show();
		$("#others_copy").hide();
		$("#others_delete_link").hide();

		var button = $(event.relatedTarget)
		var link = 'https://saas.cloudike.com/public/'+button.data('hash') 
		var $path =button.data('path') ;
		if (button.data('hash')  != '') {
			$("#create_link").hide();
			$("#copy").show();
			$('#link').val(link);
			$("#delete_link").show();
		}


		object = button.data('full')
		if (object.folder) {
			$("#tab_menu_other").show();
			if (object.shared) {

				$.ajax({
					method: "POST",
					dataType: "json",
					url: "<?php echo site_url()?>/home/prepare_share",
					data: { path:$path }
				}) .done(function( msg ) {
					$("#others_create_link").hide();
					$("#others_copy").show();
					$('#others_link').val("https://saas.cloudike.com/shares/"+msg.shared_hash);
					$("#others_delete_link").show();

				});


			}
		}



		$("#share_path").val($path);




	})  

	function others_create_link() {
		$('#others_share-spinner').show();
		$path=$('#share_path').val();
		$.ajax({
			method: "POST",
			dataType: "json",
			url: "<?php echo site_url()?>/home/others_create_link",
			data: { path:$path }
		})
		.done(function( msg ) {
      //console.log(msg);
      $('#others_link').val("https://saas.cloudike.com/shares/"+msg.hash);
      $("#others_delete_link").show();
      $('#others_share-spinner').hide();
      $("#others_create_link").hide();
      $("#others_copy").show();
  });
	}
	function create_link() {
		$('#share-spinner').show();
		$path=$('#share_path').val();
		$.ajax({
			method: "POST",
			dataType: "json",
			url: "<?php echo site_url()?>/home/create_link",
			data: { path:$path }
		})
		.done(function( msg ) {
      //console.log(msg);
      $('#link').val('https://saas.cloudike.com/public/'+msg.public_hash);
      $("#delete_link").show();
      $('#share-spinner').hide();
      $("#create_link").hide();
      $("#copy").show();
  });
	}

	function delete_link() {
		$('#share-spinner').show();
		$path=$('#share_path').val();
		$.ajax({
			method: "POST",
			dataType: "json",
			url: "<?php echo site_url()?>/home/delete_link",
			data: { path:$path }
		})
		.done(function( msg ) {
      //console.log(msg);
      $('#link').val('');
      $("#delete_link").hide();
      $('#share-spinner').hide();
      $("#create_link").show();
      $("#copy").hide();
  });
	}
	function others_delete_link() {
		$('#others_share-spinner').show();
		$path=$('#share_path').val();
		$.ajax({
			method: "POST",
			dataType: "json",
			url: "<?php echo site_url()?>/home/others_delete_link",
			data: { path:$path }
		})
		.done(function( msg ) {
      //console.log(msg);
      $('#others_link').val('');
      $("#others_delete_link").hide();
      $('#others_share-spinner').hide();
      $("#others_create_link").show();
      $("#others_copy").hide();
  });
	}
</script>

