<h2><?php echo $title; ?></h2>

<?php if (! empty($success)) : ?>
	<?php if ($success == 1) : ?>
		<div class="row">
			<div class="col-sm-3">
				<p class="bg-success fade-message" style="padding: 3px 0px 3px 0px;">URL shortened!</p>
			</div>
		</div>
	<?php else : ?>
		<div class="row">
			<div class="col-sm-3">
				<p class="bg-success fade-message" style="padding: 3px 0px 3px 0px;">There was an error shortening your URL</p>
			</div>
		</div>
	<?php endif; ?>
<?php endif; ?>

<br />
<a href="<?php echo site_url('shortener/add'); ?>" type="button" class="btn btn-primary">Shorten URL</a>
<br />
<br />

<!-- Links table -->
<table class="table table-hover">
	<!-- Header -->
	<tr>
		<th>Link</th>
		<th>Shortened Link</th>
		<th><!-- Delete Button --></th>
	</tr>

	<!-- Items -->
	<?php foreach ($links as $l): ?>
		<tr>
			<td>
				<a href="<?php echo $l['Link']; ?>"><?php echo $l['Link']; ?></a>
			</td>
			<td>
				<div class="input-group">
      				<span class="input-group-btn">
        				<button class="btn btn-default" type="button">Copy</button>
      				</span>
      				<input type="text" class="form-control" value="<?php echo site_url('s/'.$l['Lookup']); ?>" readonly>
    			</div></td>
			<td>
				<a href="<?php echo site_url('shortener/delete/'.$l['Id']); ?>" type="button" class="btn btn-danger">Delete</a>
			</td>
    </td>
		</tr>
	<?php endforeach; ?>
</table>