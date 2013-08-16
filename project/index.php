<?php require('inc/header.php'); ?>
<?php require('config.php'); ?>
<?php require('models/model.php'); $model = new Model(DB_USER, DB_PASS, DB_HOST, DB_NAME);?>

<div id="main-grid-wrapper">
	<a href="file://extension.crx">
		<div class="announcement-bar">
			<p>Click here to download our chrome extension &rarr;</p>
		</div>
	</a>
	<?php $entries = $model->getAll();?>
	<section id="main-grid">
		<?php foreach($entries as $entry) : ?>
			<article class="grid-item">
				<figure class="grid-image">
					<img alt="" src="/uploads/<?php echo $entry->thumb_name ?>" width="250" />
				</figure>
				<a data-id=<?php echo $entry->id; ?> class="grid-vote" href="#">
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