<h2><?php echo $title; ?></h2>


<h3>Top Students</h3>
<!-- Student table -->
<table class="table table-hover">
	<!-- Header -->
	<tr>
		<th>Name</th>
		<th>Floor</th>
		<th>Year</th>
		<th>Total Points</th>
		<th>Total Events</th>
	</tr>

	<!-- Items -->
	<?php foreach ($students as $s): ?>
		<tr>
			<td><?php echo $s['FirstName'].' '.$s['LastName']; ?></td>
			<td><?php echo $s['Floor'].$s['Side']; ?></td>
			<td><?php echo $s[0]['YearString']; ?></td>
			<td>
				<?php $num = $s['TotalPoints']; ?>
				<?php $percent = ($num / $PointsPossible) * 100; ?>
				<div class="progress">
					<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="<?php echo $num; ?>" aria-valuemin="0" aria-valuemax="<?php echo $PointsPossible; ?>" style="width:<?php echo $percent; ?>%">
					</div>
				</div>
				<span><?php echo $num.' / '.$PointsPossible.' points'; ?></span>
	   		</td>
	   		<td>
				<?php $num = $s['TotalEvents']; ?>
				<?php $percent = ($num / $EventsPossible) * 100; ?>
				<div class="progress">
					<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="<?php echo $num; ?>" aria-valuemin="0" aria-valuemax="<?php echo $EventsPossible; ?>" style="width:<?php echo $percent; ?>%">
	   				</div>
	   			</div>
	   			<span><?php echo $num.' / '.$EventsPossible.' events'; ?></span>
	   		</td>
		</tr>
	<?php endforeach; ?>
</table>

<h3>Floors</h3>
<!-- Floor table -->
<table class="table table-hover">
	<!-- Header -->
	<tr>
		<th>Floor</th>
		<th>Total Points</th>
	</tr>

	<!-- Items -->
	<?php foreach ($floors as $f): ?>
		<tr>
			<td><?php echo $f['Floor'] ?></td>
			<td>
				<?php $num = $f['TotalPoints']; ?>
	   		</td>
		</tr>
	<?php endforeach; ?>
</table>