<h2><?php echo $title; ?></h2>

<!-- Students table -->
<?php if (! empty($message)) : ?>
	<?php if (empty($success)) : ?>
		<p><?php echo $message; ?></p>
	<?php elseif ($success == 1) : ?>
		<p class="bg-success"><?php echo $message; ?></p>
	<?php elseif ($success == 0) : ?>
		<p class="bg-danger"><?php echo $message; ?></p>
	<?php else : ?>
		<p class="bg-warning"><?php echo $message; ?></p>
	<?php endif; ?>
<?php endif; ?>

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

<a href="<?php echo site_url('students/archive'); ?>" type="button" class="btn btn-danger">Archive all students</a>