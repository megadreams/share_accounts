<h2>Editing Category_mst</h2>
<br>

<?php echo render('category/mst/_form'); ?>
<p>
	<?php echo Html::anchor('category/mst/view/'.$category_mst->id, 'View'); ?> |
	<?php echo Html::anchor('category/mst', 'Back'); ?></p>
