<?php require('inc/header.php'); ?>
<?php require('config.php'); ?>
<?php require('models/model.php'); $model = new Model(DB_USER, DB_PASS, DB_HOST, DB_NAME);?>

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
	
	<?php $entries = $model->getAll();?>
	<section id="main-grid">
		<?php foreach($entries as $entry) : ?>
			<article class="grid-item">
				<figure class="grid-image">
					<img alt="" src="/uploads/<?php echo $entry->image_name ?>" width="250" />
				</figure>
				<a class="grid-vote<?php if($entry->condemned){ echo ' banned'; } ?>" href="#">
					<span class="grid-vote-image">
						<span class="grid-vote-icon"></span>
						<span class="grid-vote-load"></span>
					</span>
					<span class="grid-vote-shadow"></span>
					<span class="grid-text"><?php echo $entry->plus_votes; ?></span>
				</a>
			</article>
		<?php endforeach; ?>
	</section>

</div>

<?php require('inc/footer.php'); ?>