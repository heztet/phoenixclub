<?php echo validation_errors(); ?>

<?php echo form_open('links/add', 'class="form-horizontal"'); ?>
	<div class="form-group">
	    <label for='LongLink' class="col-sm-2 control-label">Long Link</label>
	    <div class="col-sm-10">		
				<input type="input" class="form-control" name="LongLink" placeholder="http://google.com" value="<?php echo set_value('LongLink'); ?>" autofocus />
		</div>
	</div>
	<div class="form-group">
	    <label for='ShortLink' class="col-sm-2 control-label">Short Link</label>
	    <div class="col-sm-10">
			<input type="input" class="form-control" name="ShortLink" placeholder="(Optional)" value="<?php echo set_value('Link'); ?>" />
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-10 col-sm-offset-2">
    		<button type="submit" class="btn btn-primary">Submit</button>
    	</div>
    </div>
</form>