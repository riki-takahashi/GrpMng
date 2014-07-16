<?php
class Controller_Sales_Term extends Controller_Template{

	public function action_index()
	{
		$data['sales_terms'] = Model_Sales_Term::find('all');
		$this->template->title = "Sales_terms";
		$this->template->content = View::forge('sales\term/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('sales/term');

		if ( ! $data['sales_term'] = Model_Sales_Term::find($id))
		{
			Session::set_flash('error', 'Could not find sales_term #'.$id);
			Response::redirect('sales/term');
		}

		$this->template->title = "Sales_term";
		$this->template->content = View::forge('sales\term/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Sales_Term::validate('create');
			
			if ($val->run())
			{
				$sales_term = Model_Sales_Term::forge(array(
					'term_name' => Input::post('term_name'),
					'start_date' => Input::post('start_date'),
					'end_date' => Input::post('end_date'),
					'note' => Input::post('note'),
				));

				if ($sales_term and $sales_term->save())
				{
					Session::set_flash('success', 'Added sales_term #'.$sales_term->id.'.');

					Response::redirect('sales/term');
				}

				else
				{
					Session::set_flash('error', 'Could not save sales_term.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Sales_Terms";
		$this->template->content = View::forge('sales\term/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('sales/term');

		if ( ! $sales_term = Model_Sales_Term::find($id))
		{
			Session::set_flash('error', 'Could not find sales_term #'.$id);
			Response::redirect('sales/term');
		}

		$val = Model_Sales_Term::validate('edit');

		if ($val->run())
		{
			$sales_term->term_name = Input::post('term_name');
			$sales_term->start_date = Input::post('start_date');
			$sales_term->end_date = Input::post('end_date');
			$sales_term->note = Input::post('note');

			if ($sales_term->save())
			{
				Session::set_flash('success', 'Updated sales_term #' . $id);

				Response::redirect('sales/term');
			}

			else
			{
				Session::set_flash('error', 'Could not update sales_term #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$sales_term->term_name = $val->validated('term_name');
				$sales_term->start_date = $val->validated('start_date');
				$sales_term->end_date = $val->validated('end_date');
				$sales_term->note = $val->validated('note');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('sales_term', $sales_term, false);
		}

		$this->template->title = "Sales_terms";
		$this->template->content = View::forge('sales\term/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('sales/term');

		if ($sales_term = Model_Sales_Term::find($id))
		{
			$sales_term->delete();

			Session::set_flash('success', 'Deleted sales_term #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete sales_term #'.$id);
		}

		Response::redirect('sales/term');

	}


}
