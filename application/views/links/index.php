<br />
<a href="<?php echo site_url('links/add'); ?>" type="button" class="btn btn-primary">Add link</a>
<br />
<br />

<?php if (count($links) > 0) : ?>
	<!-- Links table -->
	<table class="table table-hover">
		<!-- Header -->
		<tr>
			<th>Link</th>
			<th>Shortened Link</th>
			<th>Visit Count</th>
			<th><!-- Edit Button --></th>
			<th><!-- Delete Button --></th>
		</tr>

		<!-- Items -->
		<?php foreach ($links as $l): ?>
			<tr>
				<td>
					<?php /* Only get the first 40 characters of the long link */ ?>
					<?php if (strlen($l['Link']) <= 40) : ?>
						<a href="<?php echo $l['Link']; ?>"><?php echo $l['Link']; ?></a>
					<?php else : ?>
						<a href="<?php echo $l['Link']; ?>"><?php echo substr($l['Link'], 0, 40); ?>...</a>
					<?php endif; ?>					
				</td>
				<td>
					<div class="input-group">
	      				<span class="input-group-btn">
	        				<button class="btn btn-default" type="button" id="copybtn-<?php echo $l['Id']; ?>" onclick="copyText(<?php echo $l['Id']; ?>)">Copy</button>
	      				</span>
	      				<?php $url = site_url('s/'.$l['Lookup']); ?>
	      				<input type="text" class="form-control" id="text-<?php echo $l['Id']; ?>" onclick="copyText(<?php echo $l['Id']; ?>)" onkeyup="resetText(<?php echo $l['Id'].', \''.$url.'\''; ?>)" value="<?php echo $url; ?>">
	    			</div></td>
	    		<td class="text-center">
	    			<?php echo $l['VisitCount']; ?>
	    		</td>
	    		<td>
	    			<a href="<?php echo site_url('links/edit/'.$l['Id']); ?>" type="button" class="btn btn-primary">Edit</a>
				<td>
					<a href="<?php echo site_url('links/delete/'.$l['Id']); ?>" type="button" class="btn btn-danger">Delete</a>
				</td>
	    </td>
			</tr>
		<?php endforeach; ?>
	</table>
<?php else : ?>
	<p style="color: #808080;"><i>No links</i></p>	
<?php endif; ?>

<script>
	function copyText(id) {
		var textArea = document.getElementById("text-".concat(id));
		textArea.select();
		document.execCommand('copy');
	}
	function resetText(id, originalText) {
		var textArea = document.getElementById("text-".concat(id));
		textArea.value = originalText;
	}
</script>
