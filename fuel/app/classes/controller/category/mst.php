<?php
class Controller_Category_Mst extends Controller_Template 
{

	public function action_index()
	{
		$data['category_msts'] = Model_Category_Mst::find('all');
		$this->template->title = "Category_msts";
		$this->template->content = View::forge('category/mst/index', $data);

	}

	public function action_view($id = null)
	{
		$data['category_mst'] = Model_Category_Mst::find($id);

		is_null($id) and Response::redirect('Category_Mst');

		$this->template->title = "Category_mst";
		$this->template->content = View::forge('category/mst/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Category_Mst::validate('create');
			
			if ($val->run())
			{
				$category_mst = Model_Category_Mst::forge(array(
					'category_name' => Input::post('category_name'),
				));

				if ($category_mst and $category_mst->save())
				{
					Session::set_flash('success', 'Added category_mst #'.$category_mst->id.'.');

					Response::redirect('category/mst');
				}

				else
				{
					Session::set_flash('error', 'Could not save category_mst.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Category_Msts";
		$this->template->content = View::forge('category/mst/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('Category_Mst');

		$category_mst = Model_Category_Mst::find($id);

		$val = Model_Category_Mst::validate('edit');

		if ($val->run())
		{
			$category_mst->category_name = Input::post('category_name');

			if ($category_mst->save())
			{
				Session::set_flash('success', 'Updated category_mst #' . $id);

				Response::redirect('category/mst');
			}

			else
			{
				Session::set_flash('error', 'Could not update category_mst #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$category_mst->category_name = $val->validated('category_name');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('category_mst', $category_mst, false);
		}

		$this->template->title = "Category_msts";
		$this->template->content = View::forge('category/mst/edit');

	}

	public function action_delete($id = null)
	{
		if ($category_mst = Model_Category_Mst::find($id))
		{
			$category_mst->delete();

			Session::set_flash('success', 'Deleted category_mst #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete category_mst #'.$id);
		}

		Response::redirect('category/mst');

	}


}