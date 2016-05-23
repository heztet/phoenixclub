<h2><?php echo $title; ?></h2>

<?php foreach ($students as $students_item): ?>

        <h3><?php echo $students_item['PUID']; ?></h3>
        <div class="main">
                <?php echo $students_item['DateCreated']; ?>
        </div>
        <!--
        <p><a href="<?php echo site_url('events/'.$events_item['Id']); ?>">Check in</a></p>
        -->
        <hr />

<?php endforeach; ?>