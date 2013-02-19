<h2>Editing User_friend</h2>
<br>

<?php echo render('user/friend/_form'); ?>
<p>
	<?php echo Html::anchor('user/friend/view/'.$user_friend->id, 'View'); ?> |
	<?php echo Html::anchor('user/friend', 'Back'); ?></p>
