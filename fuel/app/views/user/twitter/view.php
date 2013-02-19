<h2>Viewing #<?php echo $user_twitter->id; ?></h2>

<p>
	<strong>Tw id:</strong>
	<?php echo $user_twitter->tw_id; ?></p>
<p>
	<strong>Name:</strong>
	<?php echo $user_twitter->name; ?></p>

<?php echo Html::anchor('user/twitter/edit/'.$user_twitter->id, 'Edit'); ?> |
<?php echo Html::anchor('user/twitter', 'Back'); ?>