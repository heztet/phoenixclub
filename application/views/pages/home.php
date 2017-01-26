<!DOCTYPE HTML>
<!--
	Helios by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Purdue Phoenix Club</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="<?php echo $this->config->item('base_url').'home_assets/js/ie/html5shiv.js'; ?>"></script><![endif]-->
		<link rel="stylesheet" href="<?php echo $this->config->item('base_url').'home_assets/css/main.css'; ?>" />
		<!--[if lte IE 8]><link rel="stylesheet" href="<?php echo $this->config->item('base_url').'home_assets/css/ie8.css'; ?>" /><![endif]-->
		<link rel="shortcut icon" type="image/x-icon" href="<?php echo $this->config->item('base_url').'images/facivon.ico'; ?>" />

		<!-- Google Analytics -->
		<?php include_once('application/views/partials/analytics_tracking.php'); ?>
	</head>
	<body class="homepage">
		<div id="page-wrapper">

			<!-- Header -->
				<div id="header">

					<!-- Inner -->
						<div class="inner">
							<header>
								<h1><a href="<?php echo $this->config->item('base_url'); ?>" id="logo">Phoenix Club</a></h1>
								<hr />
								<p>Purdue Hillenbrand Hall Phoenix Club</p>
							</header>
						</div>

					<!-- Nav -->
						<nav id="nav">
							<ul>
								<li><a href="https://www.facebook.com/groups/211869608867628/?fref=phoenix_club_website">Facebook</a></li>
								<li><a href="https://twitter.com/_phoenixclub">Twitter</a></li>
								<li><a href="#">Constitution</a></li>
								<!-- <li><a href="index.php/eboard">E-Board</a></li> -->
								<li><a href="<?php echo site_url('leaderboard/'); ?>">Points</a></li>
								<li><a href="<?php echo site_url('newsletter/'); ?>">Notes/Newsletter</a></li>
								<li><a href="http://www.tinyurl.com/PCRequestForm">GA Request</a></li>
								<li><a href="https://drive.google.com/file/d/0B8-AgzNZaI_HRDZRMksyUnZYT2c/view?usp=sharing">Checkout</a></li>
							</ul>
						</nav>

				</div>

			<!-- Footer -->
				<div id="footer">
					<div class="container">
						<div class="row">
							<div class="12u">
								<!-- Copyright -->
									<div class="copyright">
										<ul class="menu">
											<li>&copy; <?php echo date("Y");?> <a href="https://github.com/heztet">Nicky Marino</a></li><li><a href="http://html5up.net">HTML5 UP</a></li>
										</ul>
									</div>
							</div>
						</div>
					</div>
				</div>

		</div>

		<!-- Scripts -->
		<script src="<?php echo $this->config->item('base_url').'home_assets/js/jquery.min.js'; ?>"></script>
		<script src="<?php echo $this->config->item('base_url').'home_assets/js/jquery.dropotron.min.js'; ?>"></script>
		<script src="<?php echo $this->config->item('base_url').'home_assets/js/jquery.scrolly.min.js'; ?>"></script>
		<script src="<?php echo $this->config->item('base_url').'home_assets/js/jquery.onvisible.min.js'; ?>"></script>
		<script src="<?php echo $this->config->item('base_url').'home_assets/js/skel.min.js'; ?>"></script>
		<script src="<?php echo $this->config->item('base_url').'home_assets/js/util.js'; ?>"></script>
		<!--[if lte IE 8]><script src="<?php echo $this->config->item('base_url').'home_assets/js/ie/respond.min.js'; ?>"></script><![endif]-->
		<script src="<?php echo $this->config->item('base_url').'home_assets/js/main.js'; ?>"></script>
	</body>
</html>