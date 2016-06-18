<h2><?php echo $title; ?></h2>

<!-- Events table -->
<table class="table table-hover">
	<!-- Header -->
	<tr>
		<th>Name</th>
		<th>Date Created</th>
		<th>Points</th>
		<th># Students</th>
		<th><!-- Check In Button --></th>
		<th><!-- Close Button --></th>
	</tr>

	<!-- Items -->
	<?php foreach ($events as $events_item): ?>
		<tr>
			<td><?php echo $events_item['Title']; ?></td>
		    <td><?php echo date_format(date_create($events_item['DateCreated']), 'm/d/Y g:i A'); ?></td>
		    <td align="center"><?php echo $events_item['PointValue']; ?></td>
		    <td align="center"><?php echo $events_item['TotalStudents']; ?></td>
		    <td><a href="<?php echo site_url('events/add/'.$events_item['Id']); ?>" type="button" class="btn btn-primary">Check in</a></td>
		    <td><a href="#" type="button" class="btn btn-danger">Close</a></td>
		</tr>
	    
	<?php endforeach; ?>
</table>