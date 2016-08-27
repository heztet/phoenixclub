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
	</head>
	<body>
		<nav class="navbar navbar-inverse navbar-static-top">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="<?php echo site_url('/'); ?>">Phoenix Club</a>
				</div>
				<div id="navbar" class="collapse navbar-collapse">
					<ul class="nav navbar-nav">
						<?php if (empty($IsLeaderboard) or ($IsLeaderboard == 0)) : ?>
							<li><a href="<?php echo site_url('events/'); ?>">Events</a></li>
							<li><a href="<?php echo site_url('events/create'); ?>">Create</a></li>
						<?php endif ; ?>
						<li><a href="<?php echo site_url('contact'); ?>">Contact</a></li>
					</ul>
				</div><!--/.nav-collapse -->
			</div>
    	</nav>

    	<div class="container">