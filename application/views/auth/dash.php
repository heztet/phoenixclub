<div class="row">
	<div class="col-sm-10">
		<h2>Welcome!</h2>
	</div>
</div>

<br />

<?php
	foreach($links as $title => $link)
	{
		echo '<div class="row">';
		echo '    <div class="col-sm-10">';
		echo '        <a href="'.site_url($link).'" class="btn btn-primary" role="button">'.$title.'</a>';
		echo '    </div>';
		echo '</div>';
		echo '<br />';
	}
?>