<?php include('inc/header.php'); ?>

<div id="main-grid-wrapper">

	<div class="announcement-bar">
	
	</div>

	<div class="grid-filter">
		<label for="">Filter By:</label>
		<select id="filter-status">
			<option value="popular">Popular</option>
		</select>
		<select id="filter-category">
			<option value="all">All</option>
		</select>
	</div>

	<section id="main-grid">
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
				<span class="grid-text"><?php echo rand(100, 300); ?></span>
			</a>
		</article>
		<?php } ?>
	</section>

</div>

<?php include('inc/footer.php'); ?>