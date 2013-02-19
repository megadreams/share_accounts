<h2>Listing Category_msts</h2>
<br>
<?php if ($category_msts): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Category name</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($category_msts as $category_mst): ?>		<tr>

			<td><?php echo $category_mst->category_name; ?></td>
			<td>
				<?php echo Html::anchor('category/mst/view/'.$category_mst->id, 'View'); ?> |
				<?php echo Html::anchor('category/mst/edit/'.$category_mst->id, 'Edit'); ?> |
				<?php echo Html::anchor('category/mst/delete/'.$category_mst->id, 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Category_msts.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('category/mst/create', 'Add new Category mst', array('class' => 'btn btn-success')); ?>

</p>
