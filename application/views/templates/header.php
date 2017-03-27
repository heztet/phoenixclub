<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Purdue Phoenix Club</title>

		<!-- Bootstrap CDN -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

		<!-- Google Analytics -->
		<?php include_once('application/views/partials/analytics_tracking.php'); ?>

		<!-- Fading JS -->
		<script>
			// Fade all elements with "fade-message"
			function fadeElements() {
				// Get all elements with "fade-message"
				var elementsToFade = document.getElementsByClassName("fade-message");
				// FadeOut each element
				if (elementsToFade != undefined) {
					[].forEach.call(elementsToFade, function(element) {
						$(element).fadeOut();
					});
				}
			}
			// Run when window is loaded
			window.onload = function() {
				setTimeout(fadeElements, 1500);
			}
		</script>

		<link rel="shortcut icon" href="<?php echo $this->config->item('base_url').'images/favicon.ico'; ?>" type="image/x-icon">
	</head>
	<body>
		<nav class="navbar navbar-inverse navbar-static-top">
			<div class="container">
				<!-- Brand: Phoenix Club -->
				<div class="navbar-header">
					<a class="navbar-brand" href="<?php echo site_url('/'); ?>">Phoenix Club</a>
				</div>
				<!-- /Brand -->

				<div id="navbar" class="collapse navbar-collapse">
					<?php /* Different header options if logged in */ ?>
					<?php if (isset($username)) : ?>
					<ul class="nav navbar-nav navbar-left">
							<li><a href="<?php echo site_url('auth/dash'); ?>">Dashboard</a></li>
							<li><a href="<?php echo site_url('events/'); ?>">Events</a></li>
							<li><a href="<?php echo site_url('documents/'); ?>">Documents</a></li>
							<li><a href="<?php echo site_url('shorten/'); ?>">Links</a></li>
							<li><a href="<?php echo site_url('reset/'); ?>">Reset</a></li>
						</ul>
						<ul class="nav navbar-nav navbar-right">
							<li>
								<a href="<?php echo site_url('dash'); ?>"><?php echo $username; ?></a>
							<li>
								<p class="navbar-btn">
									<a href="<?php echo site_url('auth/logout'); ?>" class="btn btn-danger" role="button">Log out</a>
								</p>
							</li>
						<ul>
					<?php else : ?>
						<ul class="nav navbar-nav">
							<li><a href="<?php echo site_url('contact'); ?>">Contact</a></li>
						</ul>
					<?php endif ; ?>
				</div><!--/.nav-collapse -->

			</div>
    	</nav>

    	<div class="container">