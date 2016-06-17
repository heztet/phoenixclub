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

	<?php foreach ($students as $s): ?>
		<tr>
			<td><?php echo $s['FirstName'].$s['LastName']; ?></td>
			<td><?php echo $s['Floor']; ?></td>
			<td><?php echo $s['Year']; ?></td>
			<td><?php echo $s['TotalPoints']; ?></td>
			<td><?php echo $s['TotalEvents']; ?></td>
		</tr>
	<?php endforeach; ?>

</table>