<h2>Listing User_twitters</h2>
<br>
<?php if ($user_twitters): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Tw id</th>
			<th>Name</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($user_twitters as $user_twitter): ?>		<tr>

			<td><?php echo $user_twitter->tw_id; ?></td>
			<td><?php echo $user_twitter->name; ?></td>
			<td>
				<?php echo Html::anchor('user/twitter/view/'.$user_twitter->id, 'View'); ?> |
				<?php echo Html::anchor('user/twitter/edit/'.$user_twitter->id, 'Edit'); ?> |
				<?php echo Html::anchor('user/twitter/delete/'.$user_twitter->id, 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No User_twitters.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('user/twitter/create', 'Add new User twitter', array('class' => 'btn btn-success')); ?>

</p>
