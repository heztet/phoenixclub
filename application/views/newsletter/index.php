<div class="col-md-5">
	<h2><?php echo $title; ?></h2>
	
	<!-- Newsletter table -->
	<table class="table table-hover">
		<!-- Items -->
		<?php foreach ($newsletters as $n): ?>
			<tr>
				<td>
					<?php echo '<a href="'.$n['Link'].'">'.$n['Title'].'</a>' ?>
				</td>
			</tr>

		<?php endforeach; ?>
	</table>
</div>