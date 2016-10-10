<div class="row">
	<div class="col-sm-10">
		<h2><?php echo $title; ?></h2>
	</div>
</div>

<h4>Submit this form with the right password to reset all events for the next academic year.</h4>

<?php echo validation_errors('<p class="bg-danger">'); ?>
<?php if (!empty($resetFailure) and ($resetFailure == 1)) : ?>
	<div class="row">
		<div class="col-sm-3">
			<p class="bg-danger fade-message" id="ResetFailure" style="padding: 3px 0px 3px 0px;">Bad password: could not reset</p>
		</div>
	</div>
<?php elseif (!empty($resetSuccess) and ($resetSuccess) == 1) : ?>
	<div class="row">
		<div class="col-sm-3">
			<p class="bg-success fade-message" id="ResetSuccess" style="padding: 3px 0px 3px 0px;">Success! Ready for next year.</p>
		</div>
	</div>
<?php endif; ?>
<?php echo form_open('admin/index', 'class="form-horizontal"'); ?>
	<div class="form-group">
	    <label for="Password" class="col-sm-2 control-label">Password</label>
	    <div class="col-sm-4">
			<input type="password" class="form-control" name="Password" />
		</div> 
	</div>
	<div class="form-group">
		<div class="col-sm-10 col-sm-offset-2">
    		<button type="submit" class="btn btn-danger">Reset</button>
    	</div>
    </div>
</form>