<h2>Editing User_facebook</h2>
<br>

<?php echo render('user/facebook/_form'); ?>
<p>
	<?php echo Html::anchor('user/facebook/view/'.$user_facebook->id, 'View'); ?> |
	<?php echo Html::anchor('user/facebook', 'Back'); ?></p>
