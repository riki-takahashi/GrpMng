<?php
class Controller_Sales_target extends Controller_Template{

	public function action_index()
	{
		$data['sales_targets'] = Model_Sales_Target::find('all');
		$this->template->title = "売上目標情報";
		$this->template->content = View::forge('sales\target/index', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Sales_Target::validate('create');
			
			if ($val->run())
			{
				$sales_target = Model_Sales_Target::forge(array(
					'id' => Input::post('id'),
					'group_id' => Input::post('group_id'),
					'sales_term_id' => Input::post('sales_term_id'),
					'target_amount' => Input::post('target_amount'),
					'min_amount' => Input::post('min_amount'),
				));

				if ($sales_target and $sales_target->save())
				{
					Session::set_flash('success', '売上目標を追加しました。 #'.$sales_target->id.'.');

					Response::redirect('sales/target');
				}

				else
				{
					Session::set_flash('error', '売上目標の登録に失敗しました。');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "売上目標登録";
		$this->template->content = View::forge('sales\target/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('sales/target');

		if ( ! $sales_target = Model_Sales_Target::find($id))
		{
			Session::set_flash('error', '該当の売上目標が見つかりません。 #'.$id);
			Response::redirect('sales/target');
		}

		$val = Model_Sales_Target::validate('edit');

		if ($val->run())
		{
			$sales_target->group_id = Input::post('group_id');
			$sales_target->sales_term_id = Input::post('sales_term_id');
			$sales_target->target_amount = Input::post('target_amount');
			$sales_target->min_amount = Input::post('min_amount');

			if ($sales_target->save())
			{
				Session::set_flash('success', '売上目標を更新しました。 #' . $id);

				Response::redirect('sales/target');
			}

			else
			{
				Session::set_flash('error', '売上目標の更新に失敗しました。 #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$sales_target->id = $val->validated('id');
				$sales_target->group_id = $val->validated('group_id');
				$sales_target->sales_term_id = $val->validated('sales_term_id');
				$sales_target->target_amount = $val->validated('target_amount');
				$sales_target->min_amount = $val->validated('min_amount');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('sales_target', $sales_target, false);
		}

		$this->template->title = "売上目標情報";
		$this->template->content = View::forge('sales\target/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('sales/target');

		if ($sales_target = Model_Sales_Target::find($id))
		{
			$sales_target->delete();

			Session::set_flash('success', '売上目標を削除しました。 #'.$id);
		}

		else
		{
			Session::set_flash('error', '売上目標の削除に失敗しました。 #'.$id);
		}

		Response::redirect('sales/target');

	}


}
