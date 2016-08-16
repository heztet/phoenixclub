<div class="row">
	<div class="col-sm-10">
		<h2><?php echo 'Add students to: '.$title; ?></h2>
	</div>
</div>
<br />
<br />

<?php echo validation_errors('<p class="bg-danger">'); ?>
<?php if (!empty($CleanPuidError) and ($CleanPuidError == 1)) : ?>
	<p class="bg-danger fade-message" id="CleanPuidError">You must use a valid PUID</p>
<?php elseif (!empty($AlreadyAddedError) and ($AlreadyAddedError == 1)) : ?>
	<p class="bg-danger fade-message" id="AlreadyAddedError">Student has already been added to this event</p>
<?php elseif ($AddedStudent == 1) : ?>
	<p class="bg-success fade-message" id="AddedStudent">Student added successfully!</p>
<?php endif; ?>

<?php echo form_open('events/add/'.$events_item['Id'], 'class="form-horizontal"'); ?>
	
	<?php echo form_hidden('EventId', $events_item['Id'], 'id="EventId"'); ?>
	<?php echo form_hidden('PointValue', $events_item['PointValue']); ?>
	<div class="form-group">
	    <label for="PUID" class="col-sm-2 control-label">PUID</label>
	    <div class="col-sm-10">
			<input type="input" class="form-control" name="PUID" value="<?php echo ($AddedStudent == 1) ? "" : set_value('PUID'); ?>" autofocus />
		</div> 
	</div>
	<div class="form-group">
		<div class="col-sm-10 col-sm-offset-2">
    		<button type="submit" class="btn btn-primary">Add</button>
    	</div>
    </div>
</form>