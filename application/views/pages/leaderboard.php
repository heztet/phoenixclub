<h2><?php echo $title; ?></h2>

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

<h3>Students</h3>
<!-- Student table -->
<table class="table table-hover">
	<!-- Header -->
	<tr>
		<th>Name</th>
		<th>Total Points</th>
		<th>Total Events</th>
	</tr>

	<!-- Items -->
	<?php foreach ($students as $s): ?>
		<tr>
			<td><?php echo $s['FirstName'].' '.$s['LastName']; ?></td>
			<td><?php echo $s['TotalPoints']; ?></td>
	   		<td><?php echo $s['TotalEvents']; ?></td>
		</tr>
	<?php endforeach; ?>
</table>