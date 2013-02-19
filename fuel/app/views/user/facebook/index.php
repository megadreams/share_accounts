<h2>Listing User_facebooks</h2>
<br>
<?php if ($user_facebooks): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Fb id</th>
			<th>Name</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($user_facebooks as $user_facebook): ?>		<tr>

			<td><?php echo $user_facebook->fb_id; ?></td>
			<td><?php echo $user_facebook->name; ?></td>
			<td>
				<?php echo Html::anchor('user/facebook/view/'.$user_facebook->id, 'View'); ?> |
				<?php echo Html::anchor('user/facebook/edit/'.$user_facebook->id, 'Edit'); ?> |
				<?php echo Html::anchor('user/facebook/delete/'.$user_facebook->id, 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No User_facebooks.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('user/facebook/create', 'Add new User facebook', array('class' => 'btn btn-success')); ?>

</p>
