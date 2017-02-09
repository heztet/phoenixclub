<h2><?php echo $title; ?></h2>

<h3>Floors</h3>
<!-- Floor table -->
<table class="table table-hover">
	<!-- Header -->
	<tr>
		<th>Place</th>
		<th>Floor</th>
		<th>Total Points</th>
	</tr>

	<!-- Items -->
	<?php $count = 1; ?>
	<?php foreach ($floors as $f): ?>
		<tr>
			<td><?php echo $count; $count += 1; ?></td>
			<td><?php echo $f['Floor'] ?></td>
			<td><?php echo $f['TotalPoints']; ?></td>
		</tr>
	<?php endforeach; ?>
</table>

<h3>Students</h3>
<!-- Student table -->
<table class="table table-hover">
	<!-- Header -->
	<tr>
		<th>Name</th>
		<?php if(isset($username)) : ?>
			<th>Email</th>
			<th>Phone</th>
		<?php endif; ?>
		<th>Total Points</th>
		<th>Total Events</th>
	</tr>

	<!-- Items -->
	<?php foreach ($students as $s): ?>
		<tr>
			<td><?php echo $s['FirstName'].' '.$s['LastName']; ?></td>
			<?php if(isset($username)) : ?>
				<td><?php echo $s['Email']; ?></td>
				<td><?php echo $s['Phone']; ?></td>
			<?php endif; ?>
			<td><?php echo $s['TotalPoints']; ?></td>
	   		<td><?php echo $s['TotalEvents']; ?></td>
		</tr>
	<?php endforeach; ?>
</table>
