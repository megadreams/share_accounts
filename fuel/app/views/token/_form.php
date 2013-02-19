<?php echo Form::open(); ?>

	<fieldset>
		<div class="clearfix">
			<?php echo Form::label('Session id', 'session_id'); ?>

			<div class="input">
				<?php echo Form::input('session_id', Input::post('session_id', isset($token) ? $token->session_id : ''), array('class' => 'span4')); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('User profile id', 'user_profile_id'); ?>

			<div class="input">
				<?php echo Form::input('user_profile_id', Input::post('user_profile_id', isset($token) ? $token->user_profile_id : ''), array('class' => 'span4')); ?>

			</div>
		</div>
		<div class="actions">
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>

		</div>
	</fieldset>
<?php echo Form::close(); ?>