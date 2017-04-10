<table class="table table-bordered">
	<!-- Header -->
	<tr>
		<th>Name</th>
		<th>Email</th>
		<th>Phone</th>
		<th>Floor/Side</th>
		<th>Points</th>
		<th><!-- Edit button --></th>
	</tr>
	
	<!-- Items -->
	<tr>
		<td><?php echo $student['FirstName'].' '.$student['LastName']; ?></td>
		<td><?php echo $student['Email']; ?></td>
		<td><?php echo $student['Phone']; ?></td>
		<td><?php echo $student['Floor'].$student['Side']; ?></td>
		<td><?php echo $student['TotalPoints']; ?></td>
		<td><a href="<?php echo site_url('students/edit/'.$student['PUID']); ?>" class="btn btn-primary">Edit</a></td>
	</tr>
</table>

<br />

<?php echo validation_errors(); ?>

<?php echo form_open('students/add_points/'.$student['PUID'], 'class="form-horizontal"'); ?>
	<?php echo form_hidden('PUID', $student['PUID'], 'id="PUID"'); ?>

	<div class="form-group">
	    <label for="Points" class="col-sm-2 control-label">Points</label>
	    <div class="col-sm-2">
			<input type="input" class="form-control" name="Points" value="<?php echo set_value('Points'); ?>" autofocus />
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