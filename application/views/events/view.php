<h2><?php echo 'Details for event: '.$events_item['Title']; ?></h2>
<br />
<br />

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
	<tr>
			<td><?php echo $events_item['Title']; ?></td>
		    <td><?php echo date_format(date_create($events_item['DateCreated']), 'm/d/Y g:i A'); ?></td>
		    <td align="center"><?php echo $events_item['PointValue']; ?></td>
		    <td align="center"><?php echo $events_item['TotalStudents']; ?></td>
		    <td><a href="<?php echo site_url('events/add/'.$events_item['Id']); ?>" type="button" class="btn btn-primary">Check in</a></td>
		    <?php if ($events_item['IsOpen'] == 1) : ?>
		    	<td><a href="./events/close/<?php echo $events_item['Id']; ?>" type="button" class="btn btn-danger">Close</a></td>
		    <?php else : ?>
		    	<td>Closed</td>
		    <?php endif; ?>
	</tr>
</table>