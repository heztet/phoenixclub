<?php if (isset($username)) : ?>
	<div class="row">
		<div class="col-md-7">
			<a href="<?php echo site_url('documents/add'); ?>" class="btn btn-primary" role="button">Add document</a>
		</div>
	</div>
	<br>
<?php endif ; ?>

<div class="row">
	<div class="col-md-7">
		<!-- Document table -->
		<table class="table table-hover">
			<!-- Items -->
			<?php foreach ($documents as $d): ?>
				<tr>
					<td>
						<?php echo '<a href="'.prep_url($d['Link']).'">'.$d['Title'].'</a>' ?>
					</td>
				
				<?php if (isset($username)) : ?>
					<td>
						<a href="<?php echo site_url('documents/delete/'.$d['Id']); ?>" class="btn btn-danger">Delete</a>
					</td>
				<?php endif; ?>
				</tr>	
			<?php endforeach; ?>
		</table>
	</div>
</div>