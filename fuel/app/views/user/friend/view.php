<h2>Viewing #<?php echo $user_friend->id; ?></h2>

<p>
	<strong>User profile id:</strong>
	<?php echo $user_friend->user_profile_id; ?></p>
<p>
	<strong>Friend user id:</strong>
	<?php echo $user_friend->friend_user_id; ?></p>

<?php echo Html::anchor('user/friend/edit/'.$user_friend->id, 'Edit'); ?> |
<?php echo Html::anchor('user/friend', 'Back'); ?>