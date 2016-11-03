<div class="row">
	<div class="col-sm-10">
		<h2><?php echo $title; ?></h2>
	</div>
</div>
<br />
<br />

<?php echo validation_errors('<p class="bg-danger">'); ?>

<?php echo form_open('newsletter/add', 'class="form-horizontal"'); ?>
	<div class="form-group">
	    <label for="Title" class="col-sm-2 control-label">Title</label>
	    <div class="col-sm-10">
			<input type="input" class="form-control" name="Title" value="<?php echo set_value('Title'); ?>" />
		</div> 
	</div>
	<div class="form-group">
	    <label for="Link" class="col-sm-2 control-label">Link</label>
	    <div class="col-sm-10">
			<input type="input" class="form-control" name="Link" value="<?php echo set_value('Link'); ?>" />
		</div> 
	</div>
	<div class="form-group">
		<div class="col-sm-10 col-sm-offset-2">
    		<button type="submit" class="btn btn-primary">Add</button>
    	</div>
    </div>
</form>