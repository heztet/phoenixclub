<h2><?php echo $title; ?></h2>
<br>
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