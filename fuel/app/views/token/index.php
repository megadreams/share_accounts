<h2>Listing Tokens</h2>
<br>
<?php if ($tokens): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Session id</th>
			<th>User profile id</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($tokens as $token): ?>		<tr>

			<td><?php echo $token->session_id; ?></td>
			<td><?php echo $token->user_profile_id; ?></td>
			<td>
				<?php echo Html::anchor('token/view/'.$token->id, 'View'); ?> |
				<?php echo Html::anchor('token/edit/'.$token->id, 'Edit'); ?> |
				<?php echo Html::anchor('token/delete/'.$token->id, 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Tokens.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('token/create', 'Add new Token', array('class' => 'btn btn-success')); ?>

</p>
