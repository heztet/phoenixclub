<div class="row">
	<div class="col-sm-10">
		<h2><?php echo $title; ?></h2>
	</div>
</div>

<h4>Submit this form with the right password to record the rollcall winner of the week.</h4>

<?php echo validation_errors('<p class="bg-danger">'); ?>
<?php if (!empty($rollFailure) and ($rollFailure == 1)) : ?>
	<div class="row">
		<div class="col-sm-3">
			<p class="bg-danger fade-message" id="ResetFailure" style="padding: 3px 0px 3px 0px;">Error: Rollcall not recorded</p>
		</div>
	</div>
<?php elseif (!empty($rollSuccess) and ($rollSuccess) == 1) : ?>
	<div class="row">
		<div class="col-sm-3">
			<p class="bg-success fade-message" id="ResetSuccess" style="padding: 3px 0px 3px 0px;">Rollcall recorded</p>
		</div>
	</div>
<?php endif; ?>
<?php echo form_open('rollcall/index', 'class="form-horizontal"'); ?>
	<div class="form-group">
	    <label for='Floor' class="col-sm-2 control-label">Floor</label>
	    <div class="col-sm-2">
			<select autofocus name='Floor' class="form-control">
				<?php
					foreach (range(1, 8) as $num)
					{
						if ($num == 1) // 1 should be the default value
						{
							echo "<option selected='selected' value='".$num."'>";
						}
						else
						{
							echo "<option value='".$num."'>";
						}

						echo $num;
						echo "</option>";
					}
				?>
			</select>
		</div>
	</div>
	<div class="form-group">
	    <label for='Side' class="col-sm-2 control-label">Side</label>
	    <div class="col-sm-2">
			<select name='Side' class="form-control">
				<option selected='selected' value='E'>E</option>
				<option value='W'>W</option>
			</select>
		</div> 
	</div>
	<div class="form-group">
		<div class="col-sm-10 col-sm-offset-2">
    		<button type="submit" class="btn btn-primary">Record</button>
    	</div>
    </div>
</form>