<br />

<!-- Event table -->
<table class="table table-hover">
	<!-- Header -->
	<tr>
		<th>Date Created</th>
		<th>Points</th>
		<th># Students</th>
		<th><!-- Check In Button --></th>
		<th><!-- Close Button --></th>
	</tr>
	<!-- Items -->
	<tr>
	    <td><?php echo date_format(date_create($events_item['DateCreated']), 'm/d/Y g:i A'); ?></td>
	    <td align="center"><?php echo $events_item['PointValue']; ?></td>
	    <td align="center"><?php echo $events_item['TotalStudents']; ?></td>
	    <?php if ($events_item['IsOpen'] == 1) : ?>
	    	<td><a href="<?php echo site_url('events/add/'.$events_item['Id']); ?>" type="button" class="btn btn-primary">Check in</a></td>
	    	<td><a href="<?php echo site_url('events/close/'.$events_item['Id']); ?>" type="button" class="btn btn-danger">Close</a></td>
	    <?php else : ?>
	    	<td>Closed</td>
	    	<td>Closed</td>
	    <?php endif; ?>
	</tr>
</table> 

<h4>Students for this event:</h4>

<?php if (count($students) > 0) : ?>
	<br>
	
	<a href="<?php echo site_url('downloads/events/'.$events_item['Id']); ?>" type="button" class="btn btn-primary">Download students</a>

	<br><br>

	<!-- Students table -->
	<table class="table table-bordered">
		<!-- Header -->
		<tr>
			<th>Name</th>
			<th>Year</th>
			<th>Floor</th>
			<th>Email</th>
			<th>Phone</th>
			<th>Timestamp</th>
		</tr>
		
		<!-- Items -->
		<?php foreach ($students as $s): ?>
			<tr>
				<td><?php echo $s['FirstName'].' '.$s['LastName']; ?></td>
				<td><?php echo $s[0]['YearString']; ?></td>
				<td><?php echo $s['Floor'].$s['Side']; ?></td>
				<td><?php echo $s['Email']; ?></td>
				<td><?php echo $s['Phone']; ?></td>
				<td><?php echo $s['Timestamp']; ?></td>
			</tr>

		<?php endforeach; ?>
	</table>
<?php else : ?>
	<p style="color: #808080;"><i>No students for this event</i></p>	
<?php endif; ?>