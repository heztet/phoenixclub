<p>Listed below are the students eligible to attend our End of the Year Banquet. If you are not on this list and believe you should be, please Phoneix Club at <a href="mailto:hillenbrand.phoenixclub@gmail.com">Hillenbrand.PhoenixClub@gmail.com</a>.

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