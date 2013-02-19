<h2>Editing User_twitter</h2>
<br>

<?php echo render('user/twitter/_form'); ?>
<p>
	<?php echo Html::anchor('user/twitter/view/'.$user_twitter->id, 'View'); ?> |
	<?php echo Html::anchor('user/twitter', 'Back'); ?></p>
