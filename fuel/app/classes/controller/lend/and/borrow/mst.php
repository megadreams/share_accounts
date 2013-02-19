<?php
class Controller_Lend_And_Borrow_Mst extends Controller_Template 
{

	public function action_index()
	{
		$data['lend_and_borrow_msts'] = Model_Lend_And_Borrow_Mst::find('all');
		$this->template->title = "Lend_and_borrow_msts";
		$this->template->content = View::forge('lend/and/borrow/mst/index', $data);

	}

	public function action_view($id = null)
	{
		$data['lend_and_borrow_mst'] = Model_Lend_And_Borrow_Mst::find($id);

		is_null($id) and Response::redirect('Lend_And_Borrow_Mst');

		$this->template->title = "Lend_and_borrow_mst";
		$this->template->content = View::forge('lend/and/borrow/mst/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Lend_And_Borrow_Mst::validate('create');
			
			if ($val->run())
			{
				$lend_and_borrow_mst = Model_Lend_And_Borrow_Mst::forge(array(
					'from_user_id' => Input::post('from_user_id'),
					'to_user_id' => Input::post('to_user_id'),
					'category_mst_id' => Input::post('category_mst_id'),
					'item' => Input::post('item'),
					'date' => Input::post('date'),
					'status' => Input::post('status'),
					'memo' => Input::post('memo'),
					'limit' => Input::post('limit'),
				));

				if ($lend_and_borrow_mst and $lend_and_borrow_mst->save())
				{
					Session::set_flash('success', 'Added lend_and_borrow_mst #'.$lend_and_borrow_mst->id.'.');

					Response::redirect('lend/and/borrow/mst');
				}

				else
				{
					Session::set_flash('error', 'Could not save lend_and_borrow_mst.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Lend_And_Borrow_Msts";
		$this->template->content = View::forge('lend/and/borrow/mst/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('Lend_And_Borrow_Mst');

		$lend_and_borrow_mst = Model_Lend_And_Borrow_Mst::find($id);

		$val = Model_Lend_And_Borrow_Mst::validate('edit');

		if ($val->run())
		{
			$lend_and_borrow_mst->from_user_id = Input::post('from_user_id');
			$lend_and_borrow_mst->to_user_id = Input::post('to_user_id');
			$lend_and_borrow_mst->category_mst_id = Input::post('category_mst_id');
			$lend_and_borrow_mst->item = Input::post('item');
			$lend_and_borrow_mst->date = Input::post('date');
			$lend_and_borrow_mst->status = Input::post('status');
			$lend_and_borrow_mst->memo = Input::post('memo');
			$lend_and_borrow_mst->limit = Input::post('limit');

			if ($lend_and_borrow_mst->save())
			{
				Session::set_flash('success', 'Updated lend_and_borrow_mst #' . $id);

				Response::redirect('lend/and/borrow/mst');
			}

			else
			{
				Session::set_flash('error', 'Could not update lend_and_borrow_mst #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$lend_and_borrow_mst->from_user_id = $val->validated('from_user_id');
				$lend_and_borrow_mst->to_user_id = $val->validated('to_user_id');
				$lend_and_borrow_mst->category_mst_id = $val->validated('category_mst_id');
				$lend_and_borrow_mst->item = $val->validated('item');
				$lend_and_borrow_mst->date = $val->validated('date');
				$lend_and_borrow_mst->status = $val->validated('status');
				$lend_and_borrow_mst->memo = $val->validated('memo');
				$lend_and_borrow_mst->limit = $val->validated('limit');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('lend_and_borrow_mst', $lend_and_borrow_mst, false);
		}

		$this->template->title = "Lend_and_borrow_msts";
		$this->template->content = View::forge('lend/and/borrow/mst/edit');

	}

	public function action_delete($id = null)
	{
		if ($lend_and_borrow_mst = Model_Lend_And_Borrow_Mst::find($id))
		{
			$lend_and_borrow_mst->delete();

			Session::set_flash('success', 'Deleted lend_and_borrow_mst #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete lend_and_borrow_mst #'.$id);
		}

		Response::redirect('lend/and/borrow/mst');

	}


}