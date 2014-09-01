<?php
/**
 * 社員マスタコントローラクラス
 * Copyright 2014 Riki System Co.,Ltd.
 * @author i-suzuki 
 */
class Controller_Employee extends Controller_Mybase{
        
        /**
         * 初期表示
         */
	public function action_index()
	{
		$this->template->title = "社員マスタ";
		$this->template->content = ViewModel::forge('employee/index');
	}
        
        /**
         * ビュー表示（使用していません）
         * @param type $id
         */
	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('employee');

		$this->template->title = "社員マスタ";
		$this->template->content = ViewModel::forge('employee/view')->set('id', $id);
	}

        /**
         * 新規作成
         */
	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Employee::validate('create');
			
			if ($val->run())
			{
				$employee = Model_Employee::forge(array(
					'id' => Input::post('id'),
					'emp_name' => Input::post('emp_name'),
					'emp_kana' => Input::post('emp_kana'),
					'position_id' => Input::post('position_id'),
					'mail_address' => Input::post('mail_address'),
					'invalid_flag' => Input::post('invalid_flag'),
					'is_mng_flag' => Input::post('is_mng_flag'),
				));

				//グループの更新
				$employee->groups = array();
				$groups = Model_Group::find('all');
				foreach ($groups as $group) {
					$var = Input::post('group' . $group->id);
					if ($var)
					{
						$employee->groups[] = $group;
					}
				}

				if ($employee and $employee->save())
				{
					Session::set_flash('success', '社員マスタを追加しました。 #'.$employee->id.'.');

					Response::redirect('employee');
				}

				else
				{
					Session::set_flash('error', '社員マスタの登録に失敗しました。');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}
		//ドロップダウン項目の設定
		$this->setDropDownList();
		
		//所属グループの選択値をセット（デフォルトでチェックオフ）
		$is_belong = function($val) {
			return false;
		};
		$this->template->set_global('is_belong', $is_belong, false);

		$this->template->title = "社員マスタ";
		$this->template->content = View::forge('employee/create');
	}

        /**
         * 編集
         * @param type $id
         */
	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('employee');

		if ( ! $employee = Model_Employee::find($id))
		{
			Session::set_flash('error', '該当の社員が見つかりません。 #'.$id);
			Response::redirect('employee');
		}

		$val = Model_Employee::validate('edit');

		if ($val->run())
		{
			$employee->emp_name = Input::post('emp_name');
			$employee->emp_kana = Input::post('emp_kana');
			$employee->position_id = Input::post('position_id');
			$employee->mail_address = Input::post('mail_address');
			$employee->invalid_flag = Input::post('invalid_flag');
			$employee->is_mng_flag = Input::post('is_mng_flag');
			
			//グループの更新
			$employee->groups = array();
			$groups = Model_Group::find('all');
			foreach ($groups as $group) {
				$var = Input::post('group' . $group->id);
				if ($var)
				{
					$employee->groups[] = $group;
				}
			}
			
			if ($employee->save())
			{
				Session::set_flash('success', '社員マスタを更新しました。 #' . $id);

				Response::redirect('employee');
			}
			else
			{
				Session::set_flash('error', '社員マスタの更新に失敗しました。 #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$employee->emp_name = $val->validated('emp_name');
				$employee->emp_kana = $val->validated('emp_kana');
				$employee->position_id = $val->validated('position_id');
				$employee->mail_address = $val->validated('mail_address');
				$employee->invalid_flag = $val->validated('invalid_flag');
				$employee->is_mng_flag = $val->validated('is_mng_flag');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('employee', $employee, false);
		}

		//ドロップダウン項目の設定
		$this->setDropDownList();

		//所属グループの選択値をセット
		$groups = Arr::assoc_to_keyval($employee->groups, 'id', 'id');
		$is_belong = function($val) use ($groups) {
			return array_search($val, $groups);
		};
		$this->template->set_global('is_belong', $is_belong, false);

		$this->template->title = "社員マスタ";
		$this->template->content = View::forge('employee/edit');
	}

        /**
         * 削除
         * @param type $id
         */
	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('employee');

		if ($employee = Model_Employee::find($id))
		{
			unset($employee->position); //リレーションの一時解除（削除に失敗するため）
			$employee->delete();

			Session::set_flash('success', '社員マスタを削除しました。 #'.$id);
		}
		else
		{
			Session::set_flash('error', '社員マスタの削除に失敗しました。 #'.$id);
		}

		Response::redirect('employee');

	}

        /**
         * 各ドロップダウンリスト設定
         */
	private function setDropDownList()
	{
		Config::load('arrays', true);

		//グループ一覧
		$groups = Model_Group::find('all');
		$this->template->set_global('groups', $groups, false);
		//役職
		$ary_positions = Model_Position::find('all', array(
			'order_by' => array('order_no' => 'asc'),
		));
		$positions = Arr::assoc_to_keyval($ary_positions, 'id', 'position_name');
		$this->template->set_global('positions', $positions, false);
		//無効フラグ
		$invalid_flags = Config::get('arrays.invalid_flag');
		$this->template->set_global('invalid_flag', $invalid_flags, false);
		//物件担当権限
		$is_mng_flag = Config::get('arrays.is_mng_flag');
		$this->template->set_global('is_mng_flag', $is_mng_flag, false);
	}

}
