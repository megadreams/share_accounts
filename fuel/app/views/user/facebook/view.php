<h2>Viewing #<?php echo $user_facebook->id; ?></h2>

<p>
	<strong>Fb id:</strong>
	<?php echo $user_facebook->fb_id; ?></p>
<p>
	<strong>Name:</strong>
	<?php echo $user_facebook->name; ?></p>

<?php echo Html::anchor('user/facebook/edit/'.$user_facebook->id, 'Edit'); ?> |
<?php echo Html::anchor('user/facebook', 'Back'); ?>