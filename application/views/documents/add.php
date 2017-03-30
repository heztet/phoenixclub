<?php echo validation_errors(); ?>

<?php echo form_open('documents/add', 'class="form-horizontal"'); ?>
	<div class="form-group">
	    <label for="Title" class="col-sm-2 control-label">Title</label>
	    <div class="col-sm-10">
			<input type="input" class="form-control" name="Title" value="<?php echo set_value('Title'); ?>" autofocus />
		</div> 
	</div>
	<div class="form-group">
	    <label for="Link" class="col-sm-2 control-label">Link</label>
	    <div class="col-sm-10">
			<input type="input" class="form-control" name="Link" value="<?php echo set_value('Link'); ?>" />
		</div> 
	</div>
	<div class="form-group">
		<div class="col-sm-1 col-sm-offset-2">
    		<a href="<?php echo site_url('documents'); ?>" class="btn btn-danger">Cancel</a>
    	</div>
		<div class="col-sm-2">
    		<button type="submit" class="btn btn-primary">Add</button>
    	</div>
    </div>
</form>