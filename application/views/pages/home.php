<!DOCTYPE HTML>
<!--
	Dimension by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Purdue Phoenix Club</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="<?php echo $this->config->item('base_url').'home_assets/css/main.css'; ?>" />
		<!--[if lte IE 9]><link rel="stylesheet" href="<?php echo $this->config->item('base_url').'home_assets/css/ie9.css'; ?>" /><![endif]-->
		<noscript><link rel="stylesheet" href="<?php echo $this->config->item('base_url').'home_assets/css/noscript.css'; ?>" /></noscript>
		<link rel="stylesheet" href="<?php echo $this->config->item('base_url').'home_assets/css/font-awesome.min.css'; ?>" />
		<link rel="shortcut icon" href="<?php echo $this->config->item('base_url').'images/favicon.ico'; ?>" type="image/x-icon">
	</head>
	<body>

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header">
						<div class="logo">
							<!-- <span class="icon fa-fire"></span> -->
							<span class="icon fa-fire"></span>
						</div>
						<div class="content">
							<div class="inner">
								<h1>Purdue Phoenix Club</h1>
								<p>Hillenbrand Hall Phoenix Club is devoted to...</p>
								<?php if (time() <= strtotime("8 May 2017")): ?>
									<a href="<?php echo site_url('rsvp'); ?>" class="button"> RSVP for the End of Year Banquet</a>
								<?php endif; ?>
							</div>
						</div>
						<nav>
							<ul>
								<li><a href="https://www.facebook.com/groups/211869608867628/?fref=phoenix_club_website">Facebook</a></li>
								<li><a href="https://twitter.com/_phoenixclub">Twitter</a></li>
								<li><a href="#">Constitution</a></li>
								<!-- <li><a href="index.php/eboard">E-Board</a></li> -->
								<li><a href="<?php echo site_url('leaderboard/'); ?>">Points</a></li>
								<li><a href="<?php echo site_url('documents/'); ?>">Documents</a></li>
								<li><a href="http://www.tinyurl.com/PCRequestForm">GA</a></li>
								<li><a href="https://drive.google.com/file/d/0B8-AgzNZaI_HRDZRMksyUnZYT2c/view?usp=sharing">Checkout</a></li>
							</ul>
						</nav>
					</header>

				<!-- Footer -->
					<footer id="footer">
						<p class="copyright">&copy; <?php echo date("Y");?> <a href="https://nickymarino.com">Nicky Marino</a>.</p>
					</footer>

			</div>

		<!-- BG -->
			<div id="bg"></div>

	</body>
</html>
