<h2>Viewing #<?php echo $lend_and_borrow_mst->id; ?></h2>

<p>
	<strong>From user id:</strong>
	<?php echo $lend_and_borrow_mst->from_user_id; ?></p>
<p>
	<strong>To user id:</strong>
	<?php echo $lend_and_borrow_mst->to_user_id; ?></p>
<p>
	<strong>Category mst id:</strong>
	<?php echo $lend_and_borrow_mst->category_mst_id; ?></p>
<p>
	<strong>Item:</strong>
	<?php echo $lend_and_borrow_mst->item; ?></p>
<p>
	<strong>Date:</strong>
	<?php echo $lend_and_borrow_mst->date; ?></p>
<p>
	<strong>Status:</strong>
	<?php echo $lend_and_borrow_mst->status; ?></p>
<p>
	<strong>Memo:</strong>
	<?php echo $lend_and_borrow_mst->memo; ?></p>
<p>
	<strong>Limit:</strong>
	<?php echo $lend_and_borrow_mst->limit; ?></p>

<?php echo Html::anchor('lend/and/borrow/mst/edit/'.$lend_and_borrow_mst->id, 'Edit'); ?> |
<?php echo Html::anchor('lend/and/borrow/mst', 'Back'); ?>