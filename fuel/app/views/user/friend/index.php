<h2>Listing User_friends</h2>
<br>
<?php if ($user_friends): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>User profile id</th>
			<th>Friend user id</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($user_friends as $user_friend): ?>		<tr>

			<td><?php echo $user_friend->user_profile_id; ?></td>
			<td><?php echo $user_friend->friend_user_id; ?></td>
			<td>
				<?php echo Html::anchor('user/friend/view/'.$user_friend->id, 'View'); ?> |
				<?php echo Html::anchor('user/friend/edit/'.$user_friend->id, 'Edit'); ?> |
				<?php echo Html::anchor('user/friend/delete/'.$user_friend->id, 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No User_friends.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('user/friend/create', 'Add new User friend', array('class' => 'btn btn-success')); ?>

</p>
