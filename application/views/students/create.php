<div class="row">
	<div class="col-sm-10">
		<h2>Create Student</h2>
	</div>
</div>
<br />
<br />

<?php echo validation_errors('<p class="bg-danger">'); ?>

<?php echo form_open($formUrl, 'class="form-horizontal"'); ?>
	<!-- Hidden Inputs -->
		<?php echo form_hidden('TotalEvents', $Totals['Events'], 'id="TotalEvents"'); ?>
		<?php echo form_hidden('TotalPoints', $Totals['Points'], 'id="TotalPoints"'); ?>
		<!-- PUID has a hidden input (to be visible in Controller/Model)
			 and a disabled input (to be visible to the user) -->
		<?php echo form_hidden('PUID', $puid, 'id="PUID"'); ?>
	<!-- /Hidden Inputs -->

	<div class="form-group">
	    <label for="PUID" class="col-sm-2 control-label">PUID</label>
	    <div class="col-sm-10">
			<?php echo '<input type="input" class="form-control" name="PUID" value="0'.$puid.'" disabled />'; ?>
		</div> 
	</div>
	<div class="form-group">
	    <label for="FirstName" class="col-sm-2 control-label">First Name</label>
	    <div class="col-sm-10">
			<input type="input" class="form-control" name="FirstName" value="<?php echo set_value('FirstName'); ?>" autofocus />
		</div> 
	</div>
	<div class="form-group">
	    <label for="LastName" class="col-sm-2 control-label">Last Name</label>
	    <div class="col-sm-10">
			<input type="input" class="form-control" name="LastName" value="<?php echo set_value('LastName'); ?>" />
		</div> 
	</div>
	<div class="form-group">
	    <label for='Year' class="col-sm-2 control-label">Year</label>
	    <div class="col-sm-10">
			<select name='Year' class="form-control">
				<option value='1'>Freshman</option>
				<option value='2'>Sophomore</option>
				<option value='3'>Junior</option>
				<option value='4'>Senior</option>
			</select>
		</div> 
	</div>
	<div class="form-group">
	    <label for='Floor' class="col-sm-2 control-label">Floor</label>
	    <div class="col-sm-10">
			<select name='Floor' class="form-control">
				<?php
					foreach (range(1, 8) as $num)
					{
						echo "<option value='".$num."'>";
						echo $num;
						echo "</option>";
					}
				?>
			</select>
		</div> 
	</div>
	<div class="form-group">
	    <label for='Side' class="col-sm-2 control-label">Side</label>
	    <div class="col-sm-10">
			<select name='Side' class="form-control">
				<option value='1'>East</option>
				<option value='2'>West</option>
			</select>
		</div> 
	</div>
	<div class="form-group">
	    <label for='Side' class="col-sm-2 control-label">RA?</label>
	    <div class="col-sm-10">
			<input type="checkbox" name="IsRA" id="IsRA" value="1" />
		</div> 
	</div>
    <div class="form-group">
		<div class="col-sm-10 col-sm-offset-2">
    		<button type="submit" class="btn btn-primary">Create</button>
    	</div>
    </div>
</form>