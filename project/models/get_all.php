<?php
	require('../config.php');
	require('model.php');
	$model = new Model(DB_USER, DB_PASS, DB_HOST, DB_NAME);
	
	$limit = $_POST['limit'];
	$offset = $_POST['offset'];

	$entries = $model->getAll($limit, $offset);
	$output = '';
	if($entries){
		foreach($entries as $entry){
			if($entry->condemned >= 3){
				$condemned = 'banned';
			} else {
				$condemned = '';
			}
			
			$output .= "
			<article class='grid-item'>
					<figure class='grid-image'>
						<img alt='entry' src='/uploads/{$entry->thumb_name}' width='250' />
					</figure>
					<a data-id={$entry->id} class='grid-vote {$condemned}' href='#'>
						<span class='grid-vote-image'>
							<span class='grid-vote-icon'></span>
							<span class='grid-vote-load'></span>
						</span>
						<span class='grid-vote-shadow'></span>
						<span class='grid-text'>{$entry->plus_votes}</span>
					</a>
			</article>";
		}
		echo $output;
	} else {
		echo 'false';
	}
?>
