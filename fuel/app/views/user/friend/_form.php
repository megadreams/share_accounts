<?php echo Form::open(); ?>

	<fieldset>
		<div class="clearfix">
			<?php echo Form::label('User profile id', 'user_profile_id'); ?>

			<div class="input">
				<?php echo Form::input('user_profile_id', Input::post('user_profile_id', isset($user_friend) ? $user_friend->user_profile_id : ''), array('class' => 'span4')); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('Friend user id', 'friend_user_id'); ?>

			<div class="input">
				<?php echo Form::input('friend_user_id', Input::post('friend_user_id', isset($user_friend) ? $user_friend->friend_user_id : ''), array('class' => 'span4')); ?>

			</div>
		</div>
		<div class="actions">
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>

		</div>
	</fieldset>
<?php echo Form::close(); ?>