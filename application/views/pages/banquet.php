<div class="row">
	<p>The following students are eligible to be invited to the End of Year banquet:</p>
	<a href="<?php echo site_url().'/downloads/banquet'; ?>" class="btn btn-primary" role="button">Download CSV</a>
</div>

<br/ >

<div class="row">
	<!-- Student table -->
	<table class="table table-hover">
		<!-- Header -->
		<tr>
			<th>Name</th>
			<th>Email</th>
		</tr>

		<!-- Items -->
		<?php foreach ($students as $s): ?>
			<tr>
				<td><?php echo $s['FirstName'].' '.$s['LastName']; ?></td>
				<td><?php echo $s['Email']; ?></td>
			</tr>
		<?php endforeach; ?>
	</table>
</div>