<div class="row">
	<div class="col-sm-10">
		<h2><?php echo $title; ?></h2>
	</div>
</div>

<?php if (! empty($success)) : ?>
	<?php if ($success == 1) : ?>
		<div class="row">
			<div class="col-sm-3">
				<p class="bg-success fade-message" style="padding: 3px 0px 3px 0px;">Link added!</p>
			</div>
		</div>
	<?php else : ?>
		<div class="row">
			<div class="col-sm-3">
				<p class="bg-success fade-message" style="padding: 3px 0px 3px 0px;">There was an error adding the link</p>
			</div>
		</div>
	<?php endif; ?>
<?php endif; ?>

<?php echo validation_errors('<p class="bg-danger fade-message" style="padding: 3px 3px 3px 3px;">'); ?>

<?php echo form_open('links/add', 'class="form-horizontal"'); ?>
	<div class="form-group">
	    <label for='LongLink' class="col-sm-2 control-label">Long Link</label>
	    <div class="col-sm-10">		
				<input type="input" class="form-control" name="LongLink" placeholder="http://google.com" value="<?php echo set_value('LongLink'); ?>" />
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