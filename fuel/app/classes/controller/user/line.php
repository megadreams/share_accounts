<?php
class Controller_User_Line extends Controller_Template 
{

	public function action_index()
	{
		$data['user_lines'] = Model_User_Line::find('all');
		$this->template->title = "User_lines";
		$this->template->content = View::forge('user/line/index', $data);

	}

	public function action_view($id = null)
	{
		$data['user_line'] = Model_User_Line::find($id);

		is_null($id) and Response::redirect('User_Line');

		$this->template->title = "User_line";
		$this->template->content = View::forge('user/line/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_User_Line::validate('create');
			
			if ($val->run())
			{
				$user_line = Model_User_Line::forge(array(
					'line_id' => Input::post('line_id'),
					'name' => Input::post('name'),
				));

				if ($user_line and $user_line->save())
				{
					Session::set_flash('success', 'Added user_line #'.$user_line->id.'.');

					Response::redirect('user/line');
				}

				else
				{
					Session::set_flash('error', 'Could not save user_line.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "User_Lines";
		$this->template->content = View::forge('user/line/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('User_Line');

		$user_line = Model_User_Line::find($id);

		$val = Model_User_Line::validate('edit');

		if ($val->run())
		{
			$user_line->line_id = Input::post('line_id');
			$user_line->name = Input::post('name');

			if ($user_line->save())
			{
				Session::set_flash('success', 'Updated user_line #' . $id);

				Response::redirect('user/line');
			}

			else
			{
				Session::set_flash('error', 'Could not update user_line #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$user_line->line_id = $val->validated('line_id');
				$user_line->name = $val->validated('name');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('user_line', $user_line, false);
		}

		$this->template->title = "User_lines";
		$this->template->content = View::forge('user/line/edit');

	}

	public function action_delete($id = null)
	{
		if ($user_line = Model_User_Line::find($id))
		{
			$user_line->delete();

			Session::set_flash('success', 'Deleted user_line #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete user_line #'.$id);
		}

		Response::redirect('user/line');

	}


}