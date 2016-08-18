<!-- Students table -->
<table class="table table-hover">
	<!-- Header -->
	<tr>
		<th>Name</th>
		<th>Floor</th>
		<th>Year</th>
		<th>RA?</th>
	</tr>

	<!-- Student -->
	<tr>
		<td><?php echo $students_item['FirstName'].' '.$students_item['LastName']; ?></td>
		<td><?php echo $students_item['Floor']; ?></td>
		<td><?php echo $students_item[0]['YearString']; ?></td>
	</tr>
</table>