<?php echo Form::open(); ?>

	<fieldset>
		<div class="clearfix">
			<?php echo Form::label('User name', 'user_name'); ?>

			<div class="input">
				<?php echo Form::input('user_name', Input::post('user_name', isset($user_profile) ? $user_profile->user_name : ''), array('class' => 'span4')); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('User facebook id', 'user_facebook_id'); ?>

			<div class="input">
				<?php echo Form::input('user_facebook_id', Input::post('user_facebook_id', isset($user_profile) ? $user_profile->user_facebook_id : ''), array('class' => 'span4')); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('User line id', 'user_line_id'); ?>

			<div class="input">
				<?php echo Form::input('user_line_id', Input::post('user_line_id', isset($user_profile) ? $user_profile->user_line_id : ''), array('class' => 'span4')); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('User twitter id', 'user_twitter_id'); ?>

			<div class="input">
				<?php echo Form::input('user_twitter_id', Input::post('user_twitter_id', isset($user_profile) ? $user_profile->user_twitter_id : ''), array('class' => 'span4')); ?>

			</div>
		</div>
		<div class="actions">
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>

		</div>
	</fieldset>
<?php echo Form::close(); ?>