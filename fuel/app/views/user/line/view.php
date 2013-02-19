<h2>Viewing #<?php echo $user_line->id; ?></h2>

<p>
	<strong>Line id:</strong>
	<?php echo $user_line->line_id; ?></p>
<p>
	<strong>Name:</strong>
	<?php echo $user_line->name; ?></p>

<?php echo Html::anchor('user/line/edit/'.$user_line->id, 'Edit'); ?> |
<?php echo Html::anchor('user/line', 'Back'); ?>