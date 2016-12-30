<h2><?php echo $title; ?></h2>

<!-- Student table -->
<table class="table table-hover">
	<!-- Items -->
	<?php foreach ($students as $s): ?>
		<tr>
			<td><?php echo $s['FirstName'].' '.$s['LastName']; ?></td>
		</tr>
	<?php endforeach; ?>
</table>
