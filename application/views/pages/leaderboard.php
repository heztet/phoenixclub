<h2><?php echo $title; ?></h2>

<?php foreach ($students as $s): ?>

	<h3><?php echo $s['FirstName'].$s['LastName']; ?></h3>
	<div class='main'>
		<?php echo 'Points: '.$s['TotalPoints']; ?>
		<br />
		<?php echo 'Events: '.$s['TotalEvents']; ?>
		<hr />
	</div>

<?php endforeach; ?>