<h2><?php echo $title; ?></h2>

<?php foreach ($event as $events_item): ?>
	<h3><?php echo $events_item['Title']; ?></h3>
	<h3><?php echo $events_item['DateCreated']; ?></h3>
<?php endforeach; ?>