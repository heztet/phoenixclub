<?php echo validation_errors(); ?>

<?php echo form_open('students/edit/'.$student['PUID'], 'class="form-horizontal"'); ?>
	<?php echo form_hidden('PUID', $student['PUID'], 'id="PUID"'); ?>

	<div class="form-group">
	    <label for="PUID" class="col-sm-2 control-label">PUID</label>
	    <div class="col-sm-10">
			<?php echo '<input type="input" class="form-control" name="PUID" value="0'.$student['PUID'].'" disabled />'; ?>
		</div> 
	</div>
	<div class="form-group">
	    <label for="FirstName" class="col-sm-2 control-label">First Name</label>
	    <div class="col-sm-10">
			<input type="input" class="form-control" name="FirstName" value="<?php echo $student['FirstName']; ?>" autofocus />
		</div> 
	</div>
	<div class="form-group">
	    <label for="LastName" class="col-sm-2 control-label">Last Name</label>
	    <div class="col-sm-10">
			<input type="input" class="form-control" name="LastName" value="<?php echo $student['LastName']; ?>" />
		</div> 
	</div>
	<div class="form-group">
	    <label for="Email" class="col-sm-2 control-label">Email</label>
	    <div class="col-sm-10">
			<input type="input" class="form-control" name="Email" value="<?php echo $student['Email']; ?>" />
		</div>
	</div>
	<div class="form-group">
	    <label for="Phone" class="col-sm-2 control-label">Phone</label>
	    <div class="col-sm-10">
			<input type="input" class="form-control" name="Phone" value="<?php echo $student['Phone']; ?>" />
		</div> 
	</div>
	<div class="form-group">
	    <label for='Year' class="col-sm-2 control-label">Year</label>
	    <div class="col-sm-10">
			<select name='Year' class="form-control">
				<option value='1' <?php if ($student['Year'] == '1') {echo 'selected';} ?>>Freshman</option>
				<option value='2' <?php if ($student['Year'] == '2') {echo 'selected';} ?>>Sophomore</option>
				<option value='3' <?php if ($student['Year'] == '3') {echo 'selected';} ?>>Junior</option>
				<option value='4' <?php if ($student['Year'] == '4') {echo 'selected';} ?>>Senior</option>
			</select>
		</div>
	</div>
	<div class="form-group">
	    <label for='Floor' class="col-sm-2 control-label">Floor</label>
	    <div class="col-sm-10">
			<select name='Floor' class="form-control">
				<?php
					foreach (range(0, 8) as $num)
					{
						if ($num == $student['Floor'])
						{
							echo "<option selected value='".$num."'>";
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
	    <div class="col-sm-10">
			<select name='Side' class="form-control">
				<option value='E' <?php if ($student['Side'] == 'E') {echo 'selected';} ?>>East</option>
				<option value='W' <?php if ($student['Side'] == 'W') {echo 'selected';} ?>>West</option>
			</select>
		</div> 
	</div>
	<div class="form-group">
	    <label for='TotalPoints' class="col-sm-2 control-label">Total Points</label>
   		<div class="col-sm-10">
			<input type="input" class="form-control" name="TotalPoints" value="<?php echo $student['TotalPoints']; ?>" />
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-1 col-sm-offset-2">
    		<a href="<?php echo site_url('students'); ?>" class="btn btn-danger">Cancel</a>
    	</div>
		<div class="col-sm-2">
    		<button type="submit" class="btn btn-primary">Save</button>
    	</div>
    </div>
</form>