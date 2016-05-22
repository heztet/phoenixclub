<h2><?php echo $events_item['Title']; ?></h2>

<?php echo validation_errors(); ?>

<?php echo '<h2>'.$events_item['Title'].'</h2>'; ?>
<?php echo '<h3'.$events_item['DateCreated'].'</h3>'; ?>

<?php echo form_open('events/addStudent'); ?>
	<?php echo form_hidden('EventId', $events_item['EventId'], 'id="EventId"'); ?>
    <label for="PUID">PUID</label>
    <input type="input" name="PUID" /><br />

    <input type="submit" name="submit" value="Add student" />

</form>