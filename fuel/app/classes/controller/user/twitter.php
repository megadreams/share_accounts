<?php
class Controller_User_Twitter extends Controller_Template 
{

	public function action_index()
	{
		$data['user_twitters'] = Model_User_Twitter::find('all');
		$this->template->title = "User_twitters";
		$this->template->content = View::forge('user/twitter/index', $data);

	}

	public function action_view($id = null)
	{
		$data['user_twitter'] = Model_User_Twitter::find($id);

		is_null($id) and Response::redirect('User_Twitter');

		$this->template->title = "User_twitter";
		$this->template->content = View::forge('user/twitter/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_User_Twitter::validate('create');
			
			if ($val->run())
			{
				$user_twitter = Model_User_Twitter::forge(array(
					'tw_id' => Input::post('tw_id'),
					'name' => Input::post('name'),
				));

				if ($user_twitter and $user_twitter->save())
				{
					Session::set_flash('success', 'Added user_twitter #'.$user_twitter->id.'.');

					Response::redirect('user/twitter');
				}

				else
				{
					Session::set_flash('error', 'Could not save user_twitter.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "User_Twitters";
		$this->template->content = View::forge('user/twitter/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('User_Twitter');

		$user_twitter = Model_User_Twitter::find($id);

		$val = Model_User_Twitter::validate('edit');

		if ($val->run())
		{
			$user_twitter->tw_id = Input::post('tw_id');
			$user_twitter->name = Input::post('name');

			if ($user_twitter->save())
			{
				Session::set_flash('success', 'Updated user_twitter #' . $id);

				Response::redirect('user/twitter');
			}

			else
			{
				Session::set_flash('error', 'Could not update user_twitter #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$user_twitter->tw_id = $val->validated('tw_id');
				$user_twitter->name = $val->validated('name');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('user_twitter', $user_twitter, false);
		}

		$this->template->title = "User_twitters";
		$this->template->content = View::forge('user/twitter/edit');

	}

	public function action_delete($id = null)
	{
		if ($user_twitter = Model_User_Twitter::find($id))
		{
			$user_twitter->delete();

			Session::set_flash('success', 'Deleted user_twitter #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete user_twitter #'.$id);
		}

		Response::redirect('user/twitter');

	}


}