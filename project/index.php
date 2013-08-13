<?php include('inc/header.php'); ?>

<div id="main-grid">

	<?php for ($i = 1; $i <= 10; $i++) { ?>
	<article class="grid-item">
		<figure class="grid-image">
			<img alt="" src=" http://placecage.com/c/500/<?php echo rand(400, 800); ?>" width="250" />
		</figure>
		<a class="grid-vote<?php if($i == 2){ echo ' banned'; } ?>" href="#">
			<span class="grid-vote-image">
				<span class="grid-vote-icon"></span>
				<span class="grid-vote-load"></span>
			</span>
			<span class="grid-vote-shadow"></span>
			<?php echo rand(100, 300); ?>
		</a>
		<?php /*<div class="grid-overlay">
			<a class="grid-permalink" href="#" target="_blank">Permalink</a>
		</div>*/ ?>
	</article>
	<?php } ?>

</div>

<?php include('inc/footer.php'); ?>