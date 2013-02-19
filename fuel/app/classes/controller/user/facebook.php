<?php
class Controller_User_Facebook extends Controller_Template 
{

	public function action_index()
	{
		$data['user_facebooks'] = Model_User_Facebook::find('all');
		$this->template->title = "User_facebooks";
		$this->template->content = View::forge('user/facebook/index', $data);

	}

	public function action_view($id = null)
	{
		$data['user_facebook'] = Model_User_Facebook::find($id);

		is_null($id) and Response::redirect('User_Facebook');

		$this->template->title = "User_facebook";
		$this->template->content = View::forge('user/facebook/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_User_Facebook::validate('create');
			
			if ($val->run())
			{
				$user_facebook = Model_User_Facebook::forge(array(
					'fb_id' => Input::post('fb_id'),
					'name' => Input::post('name'),
				));

				if ($user_facebook and $user_facebook->save())
				{
					Session::set_flash('success', 'Added user_facebook #'.$user_facebook->id.'.');

					Response::redirect('user/facebook');
				}

				else
				{
					Session::set_flash('error', 'Could not save user_facebook.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "User_Facebooks";
		$this->template->content = View::forge('user/facebook/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('User_Facebook');

		$user_facebook = Model_User_Facebook::find($id);

		$val = Model_User_Facebook::validate('edit');

		if ($val->run())
		{
			$user_facebook->fb_id = Input::post('fb_id');
			$user_facebook->name = Input::post('name');

			if ($user_facebook->save())
			{
				Session::set_flash('success', 'Updated user_facebook #' . $id);

				Response::redirect('user/facebook');
			}

			else
			{
				Session::set_flash('error', 'Could not update user_facebook #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$user_facebook->fb_id = $val->validated('fb_id');
				$user_facebook->name = $val->validated('name');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('user_facebook', $user_facebook, false);
		}

		$this->template->title = "User_facebooks";
		$this->template->content = View::forge('user/facebook/edit');

	}

	public function action_delete($id = null)
	{
		if ($user_facebook = Model_User_Facebook::find($id))
		{
			$user_facebook->delete();

			Session::set_flash('success', 'Deleted user_facebook #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete user_facebook #'.$id);
		}

		Response::redirect('user/facebook');

	}


}