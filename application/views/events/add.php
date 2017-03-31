<br />

<?php echo validation_errors(); ?>

<?php echo form_open('events/add/'.$events_item['Id'], 'class="form-horizontal"'); ?>
	<?php echo form_hidden('EventId', $events_item['Id'], 'id="EventId"'); ?>
	<?php echo form_hidden('PointValue', $events_item['PointValue']); ?>

	<div class="form-group">
	    <label for="PUID" class="col-sm-2 control-label">PUID</label>
	    <div class="col-sm-4">
			<input type="input" class="form-control" name="PUID" autofocus />
		</div> 
	</div>
	<div class="form-group">
		<div class="col-sm-10 col-sm-offset-2">
    		<button type="submit" class="btn btn-primary">Add</button>
    	</div>
    </div>
</form>
