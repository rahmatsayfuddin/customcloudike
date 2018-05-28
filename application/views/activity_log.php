
<div class="col-sm-10">
	<h2>Activity Log</h2>

	<table class="table">
		<thead>
			<tr>
				<th>Event</th>
				<th>Object</th>
				<th>Device</th>
				<th>Item Size</th>
				<th>Date</th>
			</tr>
		</thead>
		<tbody>

			<?php foreach ($log as $log): ?>
				<tr>
					<?php 
					$activity='You ';

					if ($log['type']=='folder_created') {
						$activity.='created the folder';
					}
					elseif ($log['type']=='folder_renamed') {
						$activity.='edited the folder';
					}
					elseif ($log['type']=='folder_moved') {
						$activity.='moved the folder';
					}
					elseif ($log['type']=='folder_deleted') {
						$activity.='deleted the folder';
					}
					elseif ($log['type']=='folder_undeleted') {
						$activity.='restored the folder';
					}
					elseif ($log['type']=='file_created') {
						$activity.='created the file';
					}
					elseif ($log['type']=='file_renamed') {
						$activity.='edited the file';
					}
					elseif ($log['type']=='file_moved') {
						$activity.='moved the file';
					}
					elseif ($log['type']=='file_deleted') {
						$activity.='deleted the file';
					}
					elseif ($log['type']=='file_undeleted') {
						$activity.='restored the file';
					}
					elseif ($log['type']=='trash_cleared') {
						$activity.='cleared trash';
					}
					elseif ($log['type']=='folder_unshared') {
						$activity.='unshared the folder';
					}
					elseif ($log['type']=='share_invitation_revoked') {
						$activity.='withdraw access to the shared';
					}
					elseif ($log['type']=='share_invitation_sent') {
						$activity.='created the shared link';
					}
					elseif ($log['type']=='link_deleted') {
						$activity.='deleted the publish link';
					}
					elseif ($log['type']=='link_created') {
						$activity.='unshared the folder';
					}
					$exploded = explode('/', $log['path']);  
					$date=date('d F Y h:i:s A',substr($log['timestamp'],0,10))
					?>

					<td><?php echo $activity?></td>
					<td><?php echo '/'.end($exploded) ?></td>
					<td><?php echo $log['device'] ?></td>
					<td><?php if(isset($log['content']['size'])){echo  byte_format($log['content']['size']);}?></td>
					<td><?php echo $date?></td>
				</tr>	
			<?php endforeach ?>
			
		</tbody>
	</table>
	
</div>