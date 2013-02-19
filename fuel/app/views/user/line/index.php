<h2>Listing User_lines</h2>
<br>
<?php if ($user_lines): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Line id</th>
			<th>Name</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($user_lines as $user_line): ?>		<tr>

			<td><?php echo $user_line->line_id; ?></td>
			<td><?php echo $user_line->name; ?></td>
			<td>
				<?php echo Html::anchor('user/line/view/'.$user_line->id, 'View'); ?> |
				<?php echo Html::anchor('user/line/edit/'.$user_line->id, 'Edit'); ?> |
				<?php echo Html::anchor('user/line/delete/'.$user_line->id, 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No User_lines.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('user/line/create', 'Add new User line', array('class' => 'btn btn-success')); ?>

</p>
