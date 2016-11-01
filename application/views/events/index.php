<h2><?php echo $title; ?></h2>

<?php if (! empty($message)) : ?>
	<?php if (empty($success)) : ?>
		<p><?php echo $message; ?></p>
	<?php elseif ($success == 1) : ?>
		<div class="row">
			<div class="col-sm-3">
				<p class="bg-success fade-message" id="CleanPuidError" style="padding: 3px 0px 3px 0px;"><?php echo $message; ?></p>
			</div>
		</div>
	<?php elseif ($success == 0) : ?>
		<div class="row">
			<div class="col-sm-3">
				<p class="bg-danger fade-message" id="CleanPuidError" style="padding: 3px 0px 3px 0px;"><?php echo $message; ?></p>
			</div>
		</div>
	<?php else : ?>
		<div class="row">
			<div class="col-sm-3">
				<p class="bg-warning fade-message" id="CleanPuidError" style="padding: 3px 0px 3px 0px;"><?php echo $message; ?></p>
			</div>
		</div>
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
		    <?php if ($e['IsOpen'] == 1) : ?>
		    	<td><a href="<?php echo site_url('events/add/'.$e['Id']); ?>" type="button" class="btn btn-primary">Check in</a></td>
		    	<td><a href="<?php echo site_url('events/close/'.$e['Id']); ?>" type="button" class="btn btn-danger">Close</a></td>
		    <?php else : ?>
		    	<td>Closed</td>
		    	<td>Closed</td>
		    <?php endif; ?>
		</tr>
	    
	<?php endforeach; ?>
</table>

<?php /*
	<a href="<?php echo site_url('events/archive'); ?>" type="button" class="btn btn-danger">Archive all events</a>
*/?>