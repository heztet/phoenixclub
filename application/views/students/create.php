<h1>Add Student to Event</h1>

<?php echo validation_errors(); ?>

<?php echo form_open('students/create/'.$puid); ?>
	<?php echo form_hidden('TotalEvents', $Totals['Events'], 'id="TotalEvents'); ?>
	<?php echo form_hidden('TotalPoints', $Totals['Points'], 'id="TotalPoints'); ?>

	<label for="PUID">PUID</label>
	<?php echo '<input type="input" name="PUID" value="'.$puid.'" disabled />'; ?>
	<br />

	<label for="FirstName">First Name</label>
	<input type="input" name="FirstName" /><br />

	<label for="LastName">Last Name</label>
	<input type="input" name="LastName" /><br />

	<label for='Year'>Year</label>
	<select name='Year'>
		<option value='1'>Freshman</option>
		<option value='2'>Sophomore</option>
		<option value='3'>Junior</option>
		<option value='4'>Senior</option>
	</select>
	<br />

	<label for='Floor'>Floor</label>
	<select name='Floor'>
		<?php
		foreach (range(1, 8) as $num)
		{
			echo "<option value='".$num."'>";
			echo $num;
			echo "</option>";
		}
		?>
	</select>
	<br />

	<label for='Side'>Side</label>
	<select name='Side'>
		<option value='1'>East</option>
		<option value='2'>West</option>
	</select>
	<br />
	
    <input type="submit" name="submit" value="Create Student" />
	
</form>