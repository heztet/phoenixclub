<table class="table table-hover">
	<!-- Header -->
	<tr>
		<th>Name</th>
		<th>Points</th>
		<th><!-- Button --></th>
	</tr>
	
	<!-- Items -->
	<?php foreach ($students as $s): ?>
		<tr>
			<td><?php echo $s['FirstName'].' '.$s['LastName']; ?></td>
			<td><?php echo $s['TotalPoints']; ?></td>
			<td><a href="<?php echo site_url('students/'.$s['PUID']); ?>">Add points</a></td>
		</tr>

	<?php endforeach; ?>
</table>