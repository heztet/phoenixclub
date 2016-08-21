<h2><?php echo $title; ?></h2>

<!-- Leaderboard table -->
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
			<td><?php echo $s['Floor']; ?></td>
			<td><?php echo $s[0]['YearString']; ?></td>
			<td>
				<?php $num = $s['TotalPoints']; ?>
				<?php $percent = ($num / $PointsPossible) * 100; ?>
				<div class="progress">
					<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="<?php echo $num; ?>" aria-valuemin="0" aria-valuemax="<?php echo $PointsPossible; ?>" style="width:<?php echo $percent; ?>%">
					</div>
					<span><?php echo $num.' / '.$PointsPossible.' points'; ?></span>
				</div>
	   		</td>
	   		<td>
				<?php $num = $s['TotalEvents']; ?>
				<?php $percent = ($num / $EventsPossible) * 100; ?>
				<div class="progress">
					<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="<?php echo $num; ?>" aria-valuemin="0" aria-valuemax="<?php echo $EventsPossible; ?>" style="width:<?php echo $percent; ?>%">
	   				</div>
	   				<span><?php echo $num.' / '.$EventsPossible.' events'; ?></span>
	   			</div>
	   		</td>
		</tr>
	<?php endforeach; ?>
</table>