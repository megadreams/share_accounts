<h2>Editing Token</h2>
<br>

<?php echo render('token/_form'); ?>
<p>
	<?php echo Html::anchor('token/view/'.$token->id, 'View'); ?> |
	<?php echo Html::anchor('token', 'Back'); ?></p>
