<div class="row">
	<div class="col-sm-10">
		<h2>Welcome!</h2>
	</div>
</div>

<br />

<!-- Button actions -->
<?php
	foreach($buttons as $title => $link)
	{
		echo '<div class="row">';
		echo '    <div class="col-sm-10">';
		echo '        <a href="'.site_url($link).'" class="btn btn-primary" role="button">'.$title.'</a>';
		echo '    </div>';
		echo '</div>';
		echo '<br />';
	}
?>
<!-- /button actions -->
<br />

<p>More helpful links:</p>
<?php /* Check that links have been populated */ ?>
<?php if (isset($links) and (! empty($links))) : ?>
<!-- Link table -->
<table class="table table-hover">
	<!-- Header -->
	<tr>
		<th>Link</th>
		<th>Description</th>
	</tr>

	<!-- Items -->
	<?php foreach ($links as $link => $description) : ?>
		<tr>
			<td><a href="<?php echo site_url($link); ?>"><?php echo $link; ?></a></td>
			<td><p><?php echo $description ; ?></p></td>
		</tr>
	<?php endforeach ; ?>
</table>
<?php endif ; ?>