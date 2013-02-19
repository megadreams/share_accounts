<h2>Editing User_profile</h2>
<br>

<?php echo render('user/profile/_form'); ?>
<p>
	<?php echo Html::anchor('user/profile/view/'.$user_profile->id, 'View'); ?> |
	<?php echo Html::anchor('user/profile', 'Back'); ?></p>
