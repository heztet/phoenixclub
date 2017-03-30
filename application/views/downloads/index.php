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