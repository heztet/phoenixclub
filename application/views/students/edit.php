<table class="table table-hover">
	<!-- Header -->
	<tr>
		<th>Name</th>
		<th>Email</th>
		<th>Phone</th>
		<th>Floor/Side</th>
		<th>Points</th>
		<th><!-- Edit button --></th>
	</tr>
	
	<!-- Items -->
	<tr>
		<?php $student = $student[0]; ?>
		<td><?php echo $student['FirstName'].' '.$student['LastName']; ?></td>
		<td><?php echo $student['Email']; ?></td>
		<td><?php echo $student['Phone']; ?></td>
		<td><?php echo $student['Floor'].$student['Side']; ?></td>
		<td><?php echo $student['TotalPoints']; ?></td>
		<td><a href="<?php echo site_url('students/edit/'.$student['PUID']); ?>" class="btn btn-primary">Edit</a></td>
	</tr>
</table>