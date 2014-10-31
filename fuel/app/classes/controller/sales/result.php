<?php

/**
 * 売上実績コントローラクラス
 * Copyright 2014 Riki System Co.,Ltd.
 * @author i-suzuki
 */
class Controller_Sales_Result extends Controller_Mybase{

        /**
         * 初期表示
         */
	public function action_index()
	{
		$data['sales_results'] = Model_Sales_Result::find('all');
		$this->template->title = "売上実績情報";
		$this->template->content = View::forge('sales/result/index', $data);
	}
        
        /**
         * 新規作成
         * @param type $project_id
         */
	public function action_create($project_id = null)
	{
		if ( ! $project = Model_Project::find($project_id))
		{
			Session::set_flash('error', '該当の案件情報が見つかりません。 #'.$project_id);
			Response::redirect('sales/result/');
		}
                
		if (Input::method() == 'POST')
		{
			$val = Model_Sales_Result::validate('create');
			
			if ($val->run())
			{
				$sales_result = Model_Sales_Result::forge(array(
					'id' => Util::empty_to_null(Input::post('id')),
					'project_id' => Util::empty_to_null($project_id),
					'sales_result_name' => Util::empty_to_null(Input::post('sales_result_name')),
					'sales_date' => Util::empty_to_null(Input::post('sales_date')),
					'sales_amount' => Util::empty_to_null(Util::remove_comma(Input::post('sales_amount'))),
					'note' => Util::empty_to_space(Input::post('note')), // DB側でNull許可されていないため、入力が空なら長さ０の空文字で登録
				));

				if ($sales_result and $sales_result->save())
				{
					Session::set_flash('success', '売上実績を追加しました。 #'.$sales_result->id.'.');

					Response::redirect('project/sales/'.$project_id); //保存後のリダイレクト先
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

                $data['project_name'] = $project->project_name;
                $data['order_amount'] = $project->order_amount;
		$this->template->title = "売上実績登録";
		$this->template->content = View::forge('sales/result/create', $data);

	}

        /**
         * 編集
         * @param type $project_id
         * @param type $result_id
         */
	public function action_edit($project_id = null, $result_id = null)
	{
		is_null($result_id) and Response::redirect('project/sales/');

		if ( ! $project = Model_Project::find($project_id))
		{
			Session::set_flash('error', '該当の案件情報が見つかりません。 #'.$project_id);
			Response::redirect('sales/result/');
		}
                
		if ( ! $sales_result = Model_Sales_Result::find($result_id))
		{
			Session::set_flash('error', '該当の売上実績が見つかりません。 #'.$result_id);
			Response::redirect('sales/result/');
		}

		$val = Model_Sales_Result::validate('edit');

		if ($val->run())
		{
			$sales_result->project_id = $project_id;
			$sales_result->sales_result_name = Util::empty_to_null(Input::post('sales_result_name'));
			$sales_result->sales_date = Util::empty_to_null(Input::post('sales_date'));
			$sales_result->sales_amount = Util::empty_to_null(Util::remove_comma(Input::post('sales_amount')));
			$sales_result->note = Util::empty_to_space(Input::post('note')); // DB側でNull許可されていないため、入力が空なら長さ０の空文字で登録

			if ($sales_result->save())
			{
				Session::set_flash('success', '売上実績を更新しました。 #'.$result_id);

				Response::redirect('project/sales/'.$project_id);
			}
			else
			{
				Session::set_flash('error', '売上実績の更新に失敗しました。 #'.$result_id);
			}
		}
		else
		{
			if (Input::method() == 'POST')
			{
				//編集時、売上実績データのidを更新しない
				$sales_result->project_id = $val->validated('project_id');
				$sales_result->sales_result_name = $val->validated('sales_result_name');
				$sales_result->sales_date = $val->validated('sales_date');
				$sales_result->sales_amount = $val->validated('sales_amount');
				$sales_result->note = $val->validated('note');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('sales_result', $sales_result, false);
		}

                $data['project_name'] = $project->project_name;
		$this->template->title = "売上実績情報";
		$this->template->content = View::forge('sales/result/edit', $data);

	}

        /**
         * 削除
         * @param type $result_id
         */
	public function action_delete($result_id = null)
	{
		is_null($result_id) and Response::redirect('sales/result/');

                $sales_result = Model_Sales_Result::find($result_id);
		if ($sales_result)
		{
			$sales_result->delete();

			Session::set_flash('success', '売上実績を削除しました。 #'.$result_id);
		}

		else
		{
			Session::set_flash('error', '売上実績の削除に失敗しました。 #'.$result_id);
		}

		Response::redirect('sales/result/');

	}
}
