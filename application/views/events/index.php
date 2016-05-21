<h2><?php echo $title; ?></h2>

<?php foreach ($events as $events_item): ?>

        <h3><?php echo $events_item['Title']; ?></h3>
        <div class="main">
                <?php echo $events_item['DateCreated']; ?>
        </div>
        <p><a href="<?php echo site_url('events/'.$events_item['Id']); ?>">Check in</a></p>
        <hr />

<?php endforeach; ?>