<p>The following students are eligible to be invited to the End of Year banquet:</p>
<br />
<!-- Student table -->
<table class="table table-hover">
	<!-- Items -->
	<?php foreach ($students as $s): ?>
		<tr>
			<td><?php echo $s['FirstName'].' '.$s['LastName']; ?></td>
		</tr>
	<?php endforeach; ?>
</table>
