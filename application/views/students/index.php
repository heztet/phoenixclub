<h2><?php echo $title; ?></h2>

<!-- Events table -->
<table class="table table-hover">
	<!-- Header -->
	<tr>
		<th>Name</th>
		<th>Floor</th>
		<th>Year</th>
	</tr>

	<!-- Items -->
	<?php foreach ($students as $s): ?>
		<tr>
			<td><?php echo $s['FirstName'].' '.$s['LastName']; ?></td>
			<td><?php echo $s['Floor']; ?></td>
			<td><?php echo $s[0]['YearString']; ?></td>
		</tr>

	<?php endforeach; ?>
</table>