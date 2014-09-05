<?php
/**
 * 役職マスタコントローラクラス
 * Copyright 2014 Riki System Co.,Ltd.
 * @author i-suzuki
 */
class Controller_Position extends Controller_Mybase{

        /**
         * 初期表示
         */
	public function action_index()
	{
		$data['positions'] = Model_Position::find('all', array(
			'order_by' => array('order_no' => 'desc', 'id' => 'asc'),
		));
		$this->template->title = "役職マスタ";
		$this->template->content = View::forge('position/index', $data);

	}

        /**
         * ビュー表示（使用していない）
         * @param type $id
         */
	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('position/index/');

		if ( ! $data['position'] = Model_Position::find($id))
		{
			Session::set_flash('error', '該当の役職が見つかりません。 #'.$id);
			Response::redirect('position/index/');
		}

		$this->template->title = "役職マスタ";
		$this->template->content = View::forge('position/view', $data);

	}

        /**
         * 新規作成
         */
	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Position::validate('create');
			
			if ($val->run())
			{
				$position = Model_Position::forge(array(
					'position_name' => Input::post('position_name'),
					'order_no' => Input::post('order_no'),
				));

				if ($position and $position->save())
				{
					Session::set_flash('success', '役職マスタを追加しました。 #'.$position->id.'.');

					Response::redirect('position/index/');
				}

				else
				{
					Session::set_flash('error', '役職マスタの登録に失敗しました。');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "役職登録";
		$this->template->content = View::forge('position/create');

	}

        /**
         * 編集
         * @param type $id
         */
	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('position/index/');

		if ( ! $position = Model_Position::find($id))
		{
			Session::set_flash('error', '該当の役職が見つかりません。 #'.$id);
			Response::redirect('position/index/');
		}

		$val = Model_Position::validate('edit');

		if ($val->run())
		{
			$position->position_name = Input::post('position_name');
			$position->order_no = Input::post('order_no');

			if ($position->save())
			{
				Session::set_flash('success', '役職マスタを更新しました。 #' . $id);

				Response::redirect('position/index/');
			}

			else
			{
				Session::set_flash('error', '役職マスタの更新に失敗しました。 #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$position->position_name = $val->validated('position_name');
				$position->order_no = $val->validated('order_no');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('position', $position, false);
		}

		$this->template->title = "役職マスタ";
		$this->template->content = View::forge('position/edit');

	}

        /**
         * 削除
         * @param type $id
         */
	public function action_delete($id = null)
	{
            //バリデーションチェックのメッセージはバリデーションクラス内に定義してあるためここではメッセージ不要。
            $val = Model_Position::validate('delete');
            if ($val->run(array('id' => $id)))
            {
		if ($position = Model_Position::find($id))
		{
			$position->delete();

			Session::set_flash('success', '役職マスタを削除しました。 #'.$id);
		}
		else
		{
			Session::set_flash('error', '役職マスタの削除に失敗しました。 #'.$id);
		}
            }
            else
            {
                //バリデーションチェックNGの場合
                Session::set_flash('error', $val->error());
            }

            //初期表示
            $this -> action_index();
	}
}
