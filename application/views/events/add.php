<?php echo validation_errors(); ?>

<?php echo '<h2>'.$events_item['Title'].'</h2>'; ?>
<?php echo '<h3'.$events_item['DateCreated'].'</h3>'; ?>

<?php echo form_open('events/add/'.$events_item['Id']); ?>
	<?php echo form_hidden('EventId', $events_item['Id'], 'id="EventId"'); ?>
	<?php echo form_hidden('PointValue', $events_item['PointValue']); ?>
	
    <label for="PUID">PUID</label>
    <input type="input" name="PUID" /><br />

    <input type="submit" name="submit" value="Add student" />

</form>