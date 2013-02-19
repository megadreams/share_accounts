<?php echo Form::open(); ?>

	<fieldset>
		<div class="clearfix">
			<?php echo Form::label('From user id', 'from_user_id'); ?>

			<div class="input">
				<?php echo Form::input('from_user_id', Input::post('from_user_id', isset($lend_and_borrow_mst) ? $lend_and_borrow_mst->from_user_id : ''), array('class' => 'span4')); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('To user id', 'to_user_id'); ?>

			<div class="input">
				<?php echo Form::input('to_user_id', Input::post('to_user_id', isset($lend_and_borrow_mst) ? $lend_and_borrow_mst->to_user_id : ''), array('class' => 'span4')); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('Category mst id', 'category_mst_id'); ?>

			<div class="input">
				<?php echo Form::input('category_mst_id', Input::post('category_mst_id', isset($lend_and_borrow_mst) ? $lend_and_borrow_mst->category_mst_id : ''), array('class' => 'span4')); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('Item', 'item'); ?>

			<div class="input">
				<?php echo Form::input('item', Input::post('item', isset($lend_and_borrow_mst) ? $lend_and_borrow_mst->item : ''), array('class' => 'span4')); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('Date', 'date'); ?>

			<div class="input">
				<?php echo Form::input('date', Input::post('date', isset($lend_and_borrow_mst) ? $lend_and_borrow_mst->date : ''), array('class' => 'span4')); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('Status', 'status'); ?>

			<div class="input">
				<?php echo Form::input('status', Input::post('status', isset($lend_and_borrow_mst) ? $lend_and_borrow_mst->status : ''), array('class' => 'span4')); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('Memo', 'memo'); ?>

			<div class="input">
				<?php echo Form::input('memo', Input::post('memo', isset($lend_and_borrow_mst) ? $lend_and_borrow_mst->memo : ''), array('class' => 'span4')); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('Limit', 'limit'); ?>

			<div class="input">
				<?php echo Form::input('limit', Input::post('limit', isset($lend_and_borrow_mst) ? $lend_and_borrow_mst->limit : ''), array('class' => 'span4')); ?>

			</div>
		</div>
		<div class="actions">
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>

		</div>
	</fieldset>
<?php echo Form::close(); ?>