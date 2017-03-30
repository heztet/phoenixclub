<?php echo validation_errors(); ?>

<?php echo form_open('links/edit/'.$link['Id'], 'class="form-horizontal"'); ?>
	<?php echo form_hidden('LinkId', $link['Id'], 'id="LinkId"'); ?>
	<div class="form-group">
	    <label for='LongLink' class="col-sm-2 control-label">Long Link</label>
	    <div class="col-sm-10">		
				<input type="input" class="form-control" name="LongLink" placeholder="http://google.com" value="<?php echo $link['Link']; ?>" autofocus />
		</div>
	</div>
	<div class="form-group">
	    <label for='ShortLink' class="col-sm-2 control-label">Short Link</label>
	    <div class="col-sm-10">
			<input type="input" class="form-control" name="ShortLink" placeholder="(Optional)" value="<?php echo $link['Lookup']; ?>" />
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-1 col-sm-offset-2">
    		<a href="<?php echo site_url('links'); ?>" class="btn btn-danger">Cancel</a>
    	</div>
		<div class="col-sm-2">
    		<button type="submit" class="btn btn-primary">Save</button>
    	</div>
    </div>
</form>