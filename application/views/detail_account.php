<div class="col-md-12">
	<h2>Detail Account</h2>
	<div class="row">
		<div class="col-md-1">
			<h4>My Order</h4>
		</div>
		<div class="col-sm-10">
			<table class="table">
				<thead>
					<tr>
						<th>Description</th>
						<th>Created</th>
						<th>Expired</th>
						<th>Stopped</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($order['content'] as $content_order): ?>

						<tr>
							<td><?php echo $content_order['name'] ?></td>
							<td><?php echo date('d F Y h:i:s A',  substr($content_order['created'],0,10) )?></td>
							<td><?php echo date('d F Y h:i:s A',  substr($content_order['expired'],0,10) )?></td>
							<td>
								<?php if ($content_order['status']=='running'): ?>
									<span class="label label-success">Running</span>
									<?php else: ?>
										<span class="label label-danger">Stopped</span>
									<?php endif ?>
								</td>
							</tr>

						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>


		<div class="row">
			<div class="col-md-1">
				<h4>My statistic</h4>
			</div>
			<div class="col-sm-10">
				<table class="table">
					<thead>
						<tr>
							<th></th>
							<th>Size</th>
							<th>Count</th>
						</tr>
					</thead>
					<tbody>
						
						<?php foreach ($data['storage_stat']['file_types_count'] as $file_key=> $value_count): ?>
							<tr>
								<td><?php echo $file_key ?></td>
								<td><?php echo byte_format($data['storage_stat']['file_types_size'][$file_key]) ?></td>
								<td><?php echo  $value_count ?></td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>


	</div>