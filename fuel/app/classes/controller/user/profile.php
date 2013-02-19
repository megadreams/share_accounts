<?php
class Controller_User_Profile extends Controller_Template 
{

	public function action_index()
	{
		$data['user_profiles'] = Model_User_Profile::find('all');
		$this->template->title = "User_profiles";
		$this->template->content = View::forge('user/profile/index', $data);

	}

	public function action_view($id = null)
	{
		$data['user_profile'] = Model_User_Profile::find($id);

		is_null($id) and Response::redirect('User_Profile');

		$this->template->title = "User_profile";
		$this->template->content = View::forge('user/profile/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_User_Profile::validate('create');
			
			if ($val->run())
			{
				$user_profile = Model_User_Profile::forge(array(
					'user_name' => Input::post('user_name'),
					'user_facebook_id' => Input::post('user_facebook_id'),
					'user_line_id' => Input::post('user_line_id'),
					'user_twitter_id' => Input::post('user_twitter_id'),
				));

				if ($user_profile and $user_profile->save())
				{
					Session::set_flash('success', 'Added user_profile #'.$user_profile->id.'.');

					Response::redirect('user/profile');
				}

				else
				{
					Session::set_flash('error', 'Could not save user_profile.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "User_Profiles";
		$this->template->content = View::forge('user/profile/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('User_Profile');

		$user_profile = Model_User_Profile::find($id);

		$val = Model_User_Profile::validate('edit');

		if ($val->run())
		{
			$user_profile->user_name = Input::post('user_name');
			$user_profile->user_facebook_id = Input::post('user_facebook_id');
			$user_profile->user_line_id = Input::post('user_line_id');
			$user_profile->user_twitter_id = Input::post('user_twitter_id');

			if ($user_profile->save())
			{
				Session::set_flash('success', 'Updated user_profile #' . $id);

				Response::redirect('user/profile');
			}

			else
			{
				Session::set_flash('error', 'Could not update user_profile #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$user_profile->user_name = $val->validated('user_name');
				$user_profile->user_facebook_id = $val->validated('user_facebook_id');
				$user_profile->user_line_id = $val->validated('user_line_id');
				$user_profile->user_twitter_id = $val->validated('user_twitter_id');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('user_profile', $user_profile, false);
		}

		$this->template->title = "User_profiles";
		$this->template->content = View::forge('user/profile/edit');

	}

	public function action_delete($id = null)
	{
		if ($user_profile = Model_User_Profile::find($id))
		{
			$user_profile->delete();

			Session::set_flash('success', 'Deleted user_profile #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete user_profile #'.$id);
		}

		Response::redirect('user/profile');

	}


}