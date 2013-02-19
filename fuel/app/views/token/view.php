<h2>Viewing #<?php echo $token->id; ?></h2>

<p>
	<strong>Session id:</strong>
	<?php echo $token->session_id; ?></p>
<p>
	<strong>User profile id:</strong>
	<?php echo $token->user_profile_id; ?></p>

<?php echo Html::anchor('token/edit/'.$token->id, 'Edit'); ?> |
<?php echo Html::anchor('token', 'Back'); ?>