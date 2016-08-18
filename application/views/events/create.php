<div class="row">
	<div class="col-sm-10">
		<h2><?php echo $title; ?></h2>
	</div>
</div>
<br />
<br />

<?php echo validation_errors('<p class="bg-danger">'); ?>

<?php echo form_open('events/create', 'class="form-horizontal"'); ?>
	
	<div class="form-group">
	    <label for="Title" class="col-sm-2 control-label">Title</label>
	    <div class="col-sm-10">
			<input type="input" class="form-control" name="Title" value="<?php echo set_value('Title'); ?>" autofocus />
		</div> 
	</div>
	<div class="form-group">
	    <label for="PointValue" class="col-sm-2 control-label">Points</label>
	    <div class="col-sm-10">
			<input type="input" class="form-control" name="PointValue" value="<?php echo set_value('PointValue'); ?>" />
		</div> 	
	</div>
	<div class="form-group">
		<div class="col-sm-10 col-sm-offset-2">
    		<button type="submit" class="btn btn-primary">Create</button>
    	</div>
    </div>
</form>