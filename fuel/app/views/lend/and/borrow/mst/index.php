<h2>Listing Lend_and_borrow_msts</h2>
<br>
<?php if ($lend_and_borrow_msts): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>From user id</th>
			<th>To user id</th>
			<th>Category mst id</th>
			<th>Item</th>
			<th>Date</th>
			<th>Status</th>
			<th>Memo</th>
			<th>Limit</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($lend_and_borrow_msts as $lend_and_borrow_mst): ?>		<tr>

			<td><?php echo $lend_and_borrow_mst->from_user_id; ?></td>
			<td><?php echo $lend_and_borrow_mst->to_user_id; ?></td>
			<td><?php echo $lend_and_borrow_mst->category_mst_id; ?></td>
			<td><?php echo $lend_and_borrow_mst->item; ?></td>
			<td><?php echo $lend_and_borrow_mst->date; ?></td>
			<td><?php echo $lend_and_borrow_mst->status; ?></td>
			<td><?php echo $lend_and_borrow_mst->memo; ?></td>
			<td><?php echo $lend_and_borrow_mst->limit; ?></td>
			<td>
				<?php echo Html::anchor('lend/and/borrow/mst/view/'.$lend_and_borrow_mst->id, 'View'); ?> |
				<?php echo Html::anchor('lend/and/borrow/mst/edit/'.$lend_and_borrow_mst->id, 'Edit'); ?> |
				<?php echo Html::anchor('lend/and/borrow/mst/delete/'.$lend_and_borrow_mst->id, 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Lend_and_borrow_msts.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('lend/and/borrow/mst/create', 'Add new Lend and borrow mst', array('class' => 'btn btn-success')); ?>

</p>
