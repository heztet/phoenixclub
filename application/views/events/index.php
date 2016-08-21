<h2><?php echo $title; ?></h2>

<?php if (! empty($message)) : ?>
	<?php if (empty($success)) : ?>
		<p><?php echo $message; ?></p>
	<?php elseif ($success == 1) : ?>
		<p class="bg-success"><?php echo $message; ?></p>
	<?php elseif ($success == 0) : ?>
		<p class="bg-danger"><?php echo $message; ?></p>
	<?php else : ?>
		<p class="bg-warning"><?php echo $message; ?></p>
	<?php endif; ?>
<?php endif; ?>
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
		    	<td><a href="<?php echo site_url('events/close/'.$e['Id']); ?>" type="button" class="btn btn-danger">Close</a></td>
		    <?php else : ?>
		    	<td>Closed</td>
		    <?php endif; ?>
		</tr>
	    
	<?php endforeach; ?>
</table>

<?php /*
	<a href="<?php echo site_url('events/archive'); ?>" type="button" class="btn btn-danger">Archive all events</a>
*/?>