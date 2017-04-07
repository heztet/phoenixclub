<a href="<?php echo site_url('downloads/students'); ?>" type="button" class="btn btn-primary">Download students</a>

<br />
<br />

<?php if (count($students) > 0) : ?>
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
		<?php foreach ($students as $s): ?>
			<tr>
				<td><?php echo $s['FirstName'].' '.$s['LastName']; ?></td>
				<td><?php echo $s['Email']; ?></td>
				<td><?php echo $s['Phone']; ?></td>
				<td><?php echo $s['Floor'].$s['Side']; ?></td>
				<td><?php echo $s['TotalPoints']; ?></td>
				<td><a href="<?php echo site_url('students/edit/'.$s['PUID']); ?>" class="btn btn-primary">Edit</a></td>
			</tr>

		<?php endforeach; ?>
	</table>
<?php else : ?>
	<p style="color: #808080;"><i>No students for this event</i></p>	
<?php endif; ?>