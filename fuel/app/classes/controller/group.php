<?php
class Controller_Group extends Controller_Template{

	public function action_index()
	{
		$this->template->title = "グループマスタ";
		$this->template->content = ViewModel::forge('group/index');
	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('group');

		$this->template->title = "グループマスタ";
		$this->template->content = ViewModel::forge('group/view')->set('id', $id);
	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Group::validate('create');
			
			if ($val->run())
			{
				$group = Model_Group::forge(array(
					'group_name' => Input::post('group_name'),
					'group_kana' => Input::post('group_kana'),
					'main_emp_id' => Input::post('main_emp_id'),
					'invalid_flag' => Input::post('invalid_flag'),
				));

				if ($group and $group->save())
				{
					Session::set_flash('success', 'グループを追加しました。 #'.$group->id.'.');

					Response::redirect('group');
				}

				else
				{
					Session::set_flash('error', 'グループの登録に失敗しました。');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}
		//ドロップダウン項目の設定
		$employees = Arr::assoc_to_keyval(Model_Employee::find('all'), 'id', 'emp_name');
		$this->template->set_global('employees', $employees, false);
		Config::load('arrays', true);
		$invalid_flags = Config::get('arrays.invalid_flag');
		$this->template->set_global('invalid_flag', $invalid_flags, false);

		$this->template->title = "グループマスタ";
		$this->template->content = View::forge('group/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('group');

		if ( ! $group = Model_Group::find($id))
		{
			Session::set_flash('error', '該当のグループが見つかりません。#'.$id);
			Response::redirect('group');
		}

		$val = Model_Group::validate('edit');

		if ($val->run())
		{
			$group->group_name = Input::post('group_name');
			$group->group_kana = Input::post('group_kana');
			$group->main_emp_id = Input::post('main_emp_id');
			$group->invalid_flag = Input::post('invalid_flag');

			if ($group->save())
			{
				Session::set_flash('success', 'グループを更新しました。 #' . $id);

				Response::redirect('group');
			}

			else
			{
				Session::set_flash('error', 'グループの更新に失敗しました。 #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$group->group_name = $val->validated('group_name');
				$group->group_kana = $val->validated('group_kana');
				$group->main_emp_id = $val->validated('main_emp_id');
				$group->invalid_flag = $val->validated('invalid_flag');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('group', $group, false);
		}
		//ドロップダウン項目の設定
		$employees = Arr::assoc_to_keyval(Model_Employee::find('all'), 'id', 'emp_name');
		$this->template->set_global('employees', $employees, false);
		Config::load('arrays', true);
		$invalid_flags = Config::get('arrays.invalid_flag');
		$this->template->set_global('invalid_flag', $invalid_flags, false);

		$this->template->title = "グループマスタ";
		$this->template->content = View::forge('group/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('group');

		if ($group = Model_Group::find($id))
		{
			$group->delete();

			Session::set_flash('success', 'グループを削除しました。 #'.$id);
		}

		else
		{
			Session::set_flash('error', 'グループの削除に失敗しました。 #'.$id);
		}

		Response::redirect('group');

	}


}
