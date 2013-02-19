<?php
class Controller_User_Friend extends Controller_Template 
{

	public function action_index()
	{
		$data['user_friends'] = Model_User_Friend::find('all');
		$this->template->title = "User_friends";
		$this->template->content = View::forge('user/friend/index', $data);

	}

	public function action_view($id = null)
	{
		$data['user_friend'] = Model_User_Friend::find($id);

		is_null($id) and Response::redirect('User_Friend');

		$this->template->title = "User_friend";
		$this->template->content = View::forge('user/friend/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_User_Friend::validate('create');
			
			if ($val->run())
			{
				$user_friend = Model_User_Friend::forge(array(
					'user_profile_id' => Input::post('user_profile_id'),
					'friend_user_id' => Input::post('friend_user_id'),
				));

				if ($user_friend and $user_friend->save())
				{
					Session::set_flash('success', 'Added user_friend #'.$user_friend->id.'.');

					Response::redirect('user/friend');
				}

				else
				{
					Session::set_flash('error', 'Could not save user_friend.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "User_Friends";
		$this->template->content = View::forge('user/friend/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('User_Friend');

		$user_friend = Model_User_Friend::find($id);

		$val = Model_User_Friend::validate('edit');

		if ($val->run())
		{
			$user_friend->user_profile_id = Input::post('user_profile_id');
			$user_friend->friend_user_id = Input::post('friend_user_id');

			if ($user_friend->save())
			{
				Session::set_flash('success', 'Updated user_friend #' . $id);

				Response::redirect('user/friend');
			}

			else
			{
				Session::set_flash('error', 'Could not update user_friend #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$user_friend->user_profile_id = $val->validated('user_profile_id');
				$user_friend->friend_user_id = $val->validated('friend_user_id');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('user_friend', $user_friend, false);
		}

		$this->template->title = "User_friends";
		$this->template->content = View::forge('user/friend/edit');

	}

	public function action_delete($id = null)
	{
		if ($user_friend = Model_User_Friend::find($id))
		{
			$user_friend->delete();

			Session::set_flash('success', 'Deleted user_friend #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete user_friend #'.$id);
		}

		Response::redirect('user/friend');

	}


}