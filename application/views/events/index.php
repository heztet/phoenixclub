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
	<?php foreach ($events as $e): ?>
		<tr>
			<td><?php echo $e['Title']; ?></td>
		    <td><?php echo date_format(date_create($e['DateCreated']), 'm/d/Y g:i A'); ?></td>
		    <td align="center"><?php echo $e['PointValue']; ?></td>
		    <td align="center"><?php echo $e['TotalStudents']; ?></td>
		    <td><a href="<?php echo site_url('events/add/'.$e['Id']); ?>" type="button" class="btn btn-primary">Check in</a></td>
		    <?php if ($e['IsOpen'] == 1) : ?>
		    	<td><a href="./events/close/<?php echo $e['Id']; ?>" type="button" class="btn btn-danger">Close</a></td>
		    <?php else : ?>
		    	<td>Closed</td>
		    <?php endif; ?>
		</tr>
	    
	<?php endforeach; ?>
</table>