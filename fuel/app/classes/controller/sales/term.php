<?php
class Controller_Sales_Term extends Controller_Template{

	public function action_index()
	{
		$data['sales_terms'] = Model_Sales_Term::find('all');
		$this->template->title = "売上期間";
		$this->template->content = View::forge('sales\term/index', $data);

	}

	public function action_view($term_id = null)
	{
		is_null($term_id) and Response::redirect('sales/term');

		if ( ! $data['sales_term'] = Model_Sales_Term::find($term_id))
		{
			Session::set_flash('error', '該当の売上期間が見つかりません。 #'.$term_id);
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
					Session::set_flash('success', '売上期間を追加しました。 #'.$sales_term->id.'.');

					Response::redirect('sales/term');
				}

				else
				{
					Session::set_flash('error', '売上期間の登録に失敗しました。');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "売上期間";
		$this->template->content = View::forge('sales\term/create');

	}

	public function action_edit($term_id = null)
	{
		is_null($term_id) and Response::redirect('sales/term');

		if ( ! $sales_term = Model_Sales_Term::find($term_id))
		{
			Session::set_flash('error', '該当の売上期間が見つかりません。 #'.$term_id);
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
				Session::set_flash('success', '売上期間を更新しました。 #' . $term_id);

				Response::redirect('sales/term');
			}

			else
			{
				Session::set_flash('error', '売上期間の更新に失敗しました。 #' . $term_id);
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

		$this->template->title = "売上期間";
		$this->template->content = View::forge('sales\term/edit');

	}

	public function action_delete($term_id = null)
	{
		is_null($term_id) and Response::redirect('sales/term');

		if ($sales_term = Model_Sales_Term::find($term_id))
		{
			$sales_term->delete();

			Session::set_flash('success', '売上期間を削除しました。 #'.$term_id);
		}

		else
		{
			Session::set_flash('error', '売上期間の削除に失敗しました。 #'.$term_id);
		}

		Response::redirect('sales/term');

	}


}
