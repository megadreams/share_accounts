<?php
class Controller_Token extends Controller_Template 
{

	public function action_index()
	{
		$data['tokens'] = Model_Token::find('all');
		$this->template->title = "Tokens";
		$this->template->content = View::forge('token/index', $data);

	}

	public function action_view($id = null)
	{
		$data['token'] = Model_Token::find($id);

		is_null($id) and Response::redirect('Token');

		$this->template->title = "Token";
		$this->template->content = View::forge('token/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Token::validate('create');
			
			if ($val->run())
			{
				$token = Model_Token::forge(array(
					'session_id' => Input::post('session_id'),
					'user_profile_id' => Input::post('user_profile_id'),
				));

				if ($token and $token->save())
				{
					Session::set_flash('success', 'Added token #'.$token->id.'.');

					Response::redirect('token');
				}

				else
				{
					Session::set_flash('error', 'Could not save token.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Tokens";
		$this->template->content = View::forge('token/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('Token');

		$token = Model_Token::find($id);

		$val = Model_Token::validate('edit');

		if ($val->run())
		{
			$token->session_id = Input::post('session_id');
			$token->user_profile_id = Input::post('user_profile_id');

			if ($token->save())
			{
				Session::set_flash('success', 'Updated token #' . $id);

				Response::redirect('token');
			}

			else
			{
				Session::set_flash('error', 'Could not update token #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$token->session_id = $val->validated('session_id');
				$token->user_profile_id = $val->validated('user_profile_id');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('token', $token, false);
		}

		$this->template->title = "Tokens";
		$this->template->content = View::forge('token/edit');

	}

	public function action_delete($id = null)
	{
		if ($token = Model_Token::find($id))
		{
			$token->delete();

			Session::set_flash('success', 'Deleted token #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete token #'.$id);
		}

		Response::redirect('token');

	}


}