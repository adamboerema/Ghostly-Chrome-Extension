<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta content="width=device-width,initial-scale=1" name="viewport">
		<title>Ghostly – The place where images go to die</title>
		<link href="css/style.css" rel="stylesheet">
		<script src="js/jquery-2.0.3.min.js"></script>
		<script src="js/jquery.easing.1.3.js"></script>
		<script src="js/jquery.wookmark.min.js"></script>
		<script src="js/jquery.imagesloaded.js"></script>
		<script src="js/main.js"></script>
	</head>
	<?php require('inc/baseurl.php'); ?>
	<body>
	
		<header id="main-header">
			<div class="main-header-wrapper">
				<div class="main-heading">
					<a class="main-logo" href="#">Ghostly</a>
					<a class="main-menu" href="#">
						<span class="menu-display"></span>
						<span class="menu-hide"></span>
					</a>
					<p><em>Be the Grim Reaper of the internet.</em></p>
					
					<section class="how-it-works">
						<p><h3>How it works:</h3></p>
						<p>The Ghostly plugin when activated will scrape the current webpage for images and activate a "tagging" action. When a user clicks on an image in tagging mode, an ajax request is made to our server containing the image url.</p>
						<p>Our server will then download a resized version of the image and create a post on the ghostly feed. At this point users can view and vote on images in hopes of banishing the most hated images to the darkest pits of the internet.</p>
						<p>When enough people have banished an image, the plugin will self update and immediately recognize any banished images and replace them inside the browser.</p>
					</section>
				</div>
				<div class="signed-out">
					<a class="button red" href="#">Sign Up</a>
					<a class="button dark-grey" href="#">Login</a>
				</div>
			</div>
		</header>
		
		<section id="main-wrapper">