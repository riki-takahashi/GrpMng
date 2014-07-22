<?php
class Controller_Sales_Result extends Controller_Template{

	public function action_index()
	{
		$data['sales_results'] = Model_Sales_Result::find('all');
		$this->template->title = "売上実績情報";
		$this->template->content = View::forge('sales\result/index', $data);
	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('sales\result/index');

		$this->template->title = "売上一覧";
		$this->template->content = ViewModel::forge('sales\result/view')->set('id', $id);
	}
        
	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Sales_Result::validate('create');
			
			if ($val->run())
			{
				$sales_result = Model_Sales_Result::forge(array(
					'id' => Input::post('id'),
					'project_id' => Input::post('project_id'),
					'sales_result_name' => Input::post('sales_result_name'),
					'sales_date' => Input::post('sales_date'),
					'sales_amount' => Input::post('sales_amount'),
					'tax' => Input::post('tax'),
					'note' => Input::post('note'),
				));

				if ($sales_result and $sales_result->save())
				{
					Session::set_flash('success', '売上実績を追加しました。 #'.$sales_result->id.'.');

					Response::redirect('sales/result');
				}

				else
				{
					Session::set_flash('error', '売上実績の登録に失敗しました。');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "売上実績登録";
		$this->template->content = View::forge('sales\result/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('sales/result');

		if ( ! $sales_result = Model_Sales_Result::find($id))
		{
			Session::set_flash('error', '該当の売上実績が見つかりません。 #'.$id);
			Response::redirect('sales/result');
		}

		$val = Model_Sales_Result::validate('edit');

		if ($val->run())
		{
			$sales_result->project_id = Input::post('project_id');
			$sales_result->sales_result_name = Input::post('sales_result_name');
			$sales_result->sales_date = Input::post('sales_date');
			$sales_result->sales_amount = Input::post('sales_amount');
			$sales_result->tax = Input::post('tax');
			$sales_result->note = Input::post('note');

			if ($sales_result->save())
			{
				Session::set_flash('success', '売上実績を更新しました。 #' . $id);

				Response::redirect('sales/result');
			}

			else
			{
				Session::set_flash('error', '売上実績の更新に失敗しました。 #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$sales_result->id = $val->validated('id');
				$sales_result->project_id = $val->validated('project_id');
				$sales_result->sales_result_name = $val->validated('sales_result_name');
				$sales_result->sales_date = $val->validated('sales_date');
				$sales_result->sales_amount = $val->validated('sales_amount');
				$sales_result->tax = $val->validated('tax');
				$sales_result->note = $val->validated('note');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('sales_result', $sales_result, false);
		}

		$this->template->title = "売上実績情報";
		$this->template->content = View::forge('sales\result/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('sales/result');

		if ($sales_result = Model_Sales_Result::find($id))
		{
			$sales_result->delete();

			Session::set_flash('success', '売上実績を削除しました。 #'.$id);
		}

		else
		{
			Session::set_flash('error', '売上実績の削除に失敗しました。 #'.$id);
		}

		Response::redirect('sales/result');

	}


}
