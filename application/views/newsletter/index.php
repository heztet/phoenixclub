<h2><?php echo $title; ?></h2>
<br>

<?php if (isset($username)) : ?>
	<div class="row">
		<div class="col-md-7">
			<a href="<?php echo site_url('newsletter/add'); ?>" class="btn btn-primary" role="button">Add newsletter</a>
		</div>
	</div>
	<br>
<?php endif ; ?>

<div class="row">
	<div class="col-md-7">
		<!-- Newsletter table -->
		<table class="table table-hover">
			<!-- Items -->
			<?php foreach ($newsletters as $n): ?>
				<tr>
					<td>
						<?php echo '<a href="'.prep_url($n['Link']).'">'.$n['Title'].'</a>' ?>
					</td>
				</tr>
			<?php endforeach; ?>
		</table>
	</div>
</div>