<div class="row">
	<div class="col-md-7">
		<a href="<?php echo site_url('events/create'); ?>" class="btn btn-primary" role="button">Create event</a>
	</div>
</div>

<br />

<?php if (count($events) > 0) : ?>
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
			<th><!-- View Event Button --></th>
		</tr>

		<!-- Items -->
		<?php foreach ($events as $e): ?>
			<tr>
				<td><a href="<?php echo site_url('events/'.$e['Id']); ?>"><?php echo $e['Title']; ?></a></td>
			    <td><?php echo date_format(date_create($e['DateCreated']), 'm/d/Y g:i A'); ?></td>
			    <td align="center"><?php echo $e['PointValue']; ?></td>
			    <td align="center"><?php echo $e['TotalStudents']; ?></td>
			    <?php if ($e['IsOpen'] == 1) : ?>
			    	<td><a href="<?php echo site_url('events/add/'.$e['Id']); ?>" type="button" class="btn btn-primary">Check in</a></td>
			    	<td><a href="<?php echo site_url('events/close/'.$e['Id']); ?>" type="button" class="btn btn-danger">Close</a></td>
			    <?php else : ?>
			    	<td>Closed</td>
			    	<td>Closed</td>
			    <?php endif; ?>
				<td><a href="<?php echo site_url('events/'.$e['Id']); ?>" type="button" class="btn btn-success	">View</a></td>
			</tr>
		<?php endforeach; ?>
	</table>
<?php else : ?>
	<p style="color: #808080;"><i>No events</i></p>
<?php endif; ?>