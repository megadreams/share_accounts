<h2>Viewing #<?php echo $user_profile->id; ?></h2>

<p>
	<strong>User name:</strong>
	<?php echo $user_profile->user_name; ?></p>
<p>
	<strong>User facebook id:</strong>
	<?php echo $user_profile->user_facebook_id; ?></p>
<p>
	<strong>User line id:</strong>
	<?php echo $user_profile->user_line_id; ?></p>
<p>
	<strong>User twitter id:</strong>
	<?php echo $user_profile->user_twitter_id; ?></p>

<?php echo Html::anchor('user/profile/edit/'.$user_profile->id, 'Edit'); ?> |
<?php echo Html::anchor('user/profile', 'Back'); ?>