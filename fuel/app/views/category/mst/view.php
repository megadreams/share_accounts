<h2>Viewing #<?php echo $category_mst->id; ?></h2>

<p>
	<strong>Category name:</strong>
	<?php echo $category_mst->category_name; ?></p>

<?php echo Html::anchor('category/mst/edit/'.$category_mst->id, 'Edit'); ?> |
<?php echo Html::anchor('category/mst', 'Back'); ?>