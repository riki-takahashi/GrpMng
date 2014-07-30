<?php
class Controller_Project extends Controller_Mybase
{
	const TEMP_ID = 99999;

        /**
         * beforeメソッドはTemplateを使用するために必要
         */
        public function before() {
            parent::before(); // この行がないと、テンプレートが動作しません!
            // 何かする
        }
        
        /**
         * $response をパラメータとして追加し、after() を Controller_Template 互換にする
         */
        public function after($response) {
            $response = parent::after($response); // あなた自身のレスポンスオブジェクトを作成する場合は必要ありません。
            // do stuff

            return $response; // after() は確実に Response オブジェクトを返すように
        }
        
        public function action_search($project_name = null, $group_id = null, $emp_id = null) {
            //ビューに渡す配列の初期化
            $data = array();

            if (Input::method() == 'POST') {
                
                $project_name = Input::post('project_name');
                $group_id = Input::post('group_id');
                $emp_id = Input::post('emp_id');

                $this->action_index($project_name, $group_id, $emp_id);
                Response::redirect('project/index/'.$group_id.'/'.$emp_id.'/');
            }

            //ドロップダウン項目の設定
            $this->setDropDownList(true);

            $this->template->set_global('project_name', $project_name);
            $this->template->set_global('group_id', $group_id);
            $this->template->set_global('emp_id', $emp_id);

            //検索条件を保持
            $data['project_name'] = $project_name;
            $data['group_id'] = $group_id;
            $data['emp_id'] = $emp_id;

            //テンプレートファイルにデータの引き渡し
            $this->template->title = "案件検索";
            $this->template->content = View::forge('project/search', $data);
        }
        
	public function action_index($project_name = null, $group_id = null)
	{
		//案件一覧データ
		$data['projects'] = Model_Project::find('all', array(
			'order_by' => array('start_date' => 'desc'),
		));

		$this->template->title = "案件一覧";
		$this->template->content = View::forge('project/index', $data);

	}

	public function action_view($project_id = null)
	{
		is_null($project_id) and Response::redirect('project');

		//案件データ
		if ( ! $project = Model_Project::find($project_id))
		{
			Session::set_flash('error', '該当の案件が見つかりません。 #'.$project_id);
			Response::redirect('project');
		}
		$data['project'] = $project;

		$this->template->title = "案件詳細";
		$this->template->content = View::forge('project/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Project::validate('create');
			
			if ($val->run())
			{
				$project = Model_Project::forge(array(
					'project_name' => Input::post('project_name'),
					'group_id' => Input::post('group_id'),
					'emp_id' => Input::post('emp_id'),
					'start_date' => Input::post('start_date'),
					'end_date' => Input::post('end_date'),
					'order_amount' => Util::empty_to_null(Input::post('order_amount')),
					'delivery_date' => Util::empty_to_null(Input::post('delivery_date')),
					'sales_date' => Util::empty_to_null(Input::post('sales_date')),
					'end_user' => Util::empty_to_null(Input::post('end_user')),
					'order_user' => Util::empty_to_null(Input::post('order_user')),
					'note' => Util::empty_to_null(Input::post('note')),
				));
				
				if ($project and $project->save())
				{
					Session::set_flash('success', '案件を追加しました。 #'.$project->id.'.');

					Response::redirect('project');
				}

				else
				{
					Session::set_flash('error', '案件情報の登録に失敗しました。');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}
		//ドロップダウン項目の設定
		$this->setDropDownList();

		$this->template->title = "案件登録";
		$this->template->content = View::forge('project/create');

	}

	public function action_edit($project_id = null)
	{
		is_null($project_id) and Response::redirect('project');

		if ( ! $project = Model_Project::find($project_id))
		{
			Session::set_flash('error', '該当の案件が見つかりません。 #'.$project_id);
			Response::redirect('project');
		}

		$val = Model_Project::validate('edit');

		if ($val->run())
		{
			$project->project_name = Input::post('project_name');
			$project->group_id = Input::post('group_id');
			$project->emp_id = Input::post('emp_id');
			$project->start_date = Input::post('start_date');
			$project->end_date = Input::post('end_date');
			$project->order_amount = Util::empty_to_null(Input::post('order_amount'));
			$project->delivery_date = Util::empty_to_null(Input::post('delivery_date'));
			$project->sales_date = Util::empty_to_null(Input::post('sales_date'));
			$project->end_user = Util::empty_to_null(Input::post('end_user'));
			$project->order_user = Util::empty_to_null(Input::post('order_user'));
			$project->note = Util::empty_to_null(Input::post('note'));

			if ($project->save())
			{
				Session::set_flash('success', '案件情報を更新しました。 #'.$project_id);

				Response::redirect('project');
			}

			else
			{
				Session::set_flash('error', '案件情報の更新に失敗しました。 #'.$project_id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$project->project_name = $val->validated('project_name');
				$project->group_id = $val->validated('group_id');
				$project->emp_id = $val->validated('emp_id');
				$project->start_date = $val->validated('start_date');
				$project->end_date = $val->validated('end_date');
				$project->order_amount = $val->validated('order_amount');
				$project->delivery_date = $val->validated('delivery_date');
				$project->sales_date = $val->validated('sales_date');
				$project->end_user = $val->validated('end_user');
				$project->order_user = $val->validated('order_user');
				$project->note = $val->validated('note');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('project', $project, false);
		}
		//ドロップダウン項目の設定
		$this->setDropDownList();

		$this->template->title = "案件編集";
		$this->template->content = View::forge('project/edit');

	}

	public function action_delete($project_id = null)
	{
		is_null($project_id) and Response::redirect('project');

		if ($project = Model_Project::find($project_id))
		{
			$project->delete();

			Session::set_flash('success', '案件情報を削除しました。 #'.$project_id);
		}
		else
		{
			Session::set_flash('error', '案件情報の削除に失敗しました。 #'.$project_id);
		}

		Response::redirect('project');
	}
	
	//案件メンバー
	public function action_member($project_id = null, $member_id = null)
	{
		is_null($project_id) and Response::redirect('project');

		//案件データ
		if ( ! $project = Model_Project::find($project_id))
		{
			Session::set_flash('error', '該当の案件が見つかりません。 #'.$project_id);
			Response::redirect('project');
		}
		
		if (Input::method() == 'POST')
		{
			$val = Model_Projectmember::validate('edit');

			if ($val->run())
			{
				if ($member = Model_Projectmember::find($member_id))
				{
					//更新処理
					$member->start_date = Input::post('start_date');
					$member->end_date = Input::post('end_date');
					$member->note = Util::empty_to_null(Input::post('note'));

					if ($member->save())
					{
						Session::set_flash('success', 'メンバー情報を更新しました。 #'.$member_id);

						Response::redirect('project/member/'.$project->id);
					}
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}
		
		$data['project'] = $project;
		$data['member_id'] = $member_id;
		$data['temp_id'] = self::TEMP_ID;

		$this->template->title = "案件メンバー登録";
		$this->template->content = View::forge('project/member', $data);

	}
	
	//案件メンバー追加
	public function action_mcreate($project_id = null)
	{
		is_null($project_id) and Response::redirect('project');

		//案件データ
		if ( ! $project = Model_Project::find($project_id))
		{
			Session::set_flash('error', '該当の案件が見つかりません。 #'.$project_id);
			Response::redirect('project');
		}
		
		if (Input::method() == 'POST')
		{
			$val = Model_Projectmember::validate('edit');

			if ($val->run())
			{
				$member = Model_Projectmember::forge(array(
					'project_id' => $project_id,
					'emp_id' => Input::post('emp_id'),
					'start_date' => Input::post('start_date'),
					'end_date' => Input::post('end_date'),
					'note' => Util::empty_to_null(Input::post('note')),
				));
				if ($member->save())
				{
					Session::set_flash('success', 'メンバー情報を追加しました。 #'.$member->id);

					Response::redirect('project/member/'.$project->id);
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}
		else
		{
			//新規案件メンバー登録用初期データの生成
			$member = Model_Projectmember::forge(array(
				'id' => self::TEMP_ID,
				'project_id' => $project_id,
				'start_date' => str_replace('-', '/', $project->start_date),
				'end_date' => str_replace('-', '/', $project->end_date),
			));
			$project->members[] = $member;

			//ドロップダウン項目の設定
			$this->setMemberDropDown();
		}
		
		$data['project'] = $project;
		$data['member_id'] = self::TEMP_ID;
		$data['temp_id'] = self::TEMP_ID;

		$this->template->title = "案件メンバー登録";
		$this->template->content = View::forge('project/member', $data);
	}

	//案件メンバー削除
	public function action_mdelete($project_id = null, $member_id = null)
	{
		is_null($member_id) and Response::redirect('project');

		if ($member = Model_Projectmember::find($member_id))
		{
			$member->delete();

			Session::set_flash('success', '案件メンバー情報を削除しました。 #'.$member_id);
		}
		else
		{
			Session::set_flash('error', '案件メンバーの削除に失敗しました。 #'.$member_id);
		}

		Response::redirect('project/member/'.$project_id);
	}
	
	private function setDropDownList($add_blank = false)
	{
		//グループ一覧
		$m_groups = Model_Group::find('all');
		$groups = Arr::assoc_to_keyval($m_groups, 'id', 'group_name');
                if($add_blank == true){
                    Arr::insert_assoc($groups, array(""), 0);
                }
		$this->template->set_global('groups', $groups, false);
                
		//社員一覧
		$m_employees = Model_Employee::find('all', array(
			'where' => array(
				array('is_mng_flag', '1'),
			),
			'order_by' => array('emp_kana' => 'asc'),
		));
		$employees = Arr::assoc_to_keyval($m_employees, 'id', 'emp_name');
                if($add_blank == true){
                    Arr::insert_assoc($employees, array(""), 0);
                }
		$this->template->set_global('employees', $employees, false);
	}
	
	private function setMemberDropDown()
	{
		//社員一覧
		$m_employees = Model_Employee::find('all', array(
			'where' => array(
				array('invalid_flag', '0'),
			),
			'order_by' => array('emp_kana' => 'asc'),
		));
		$employees = Arr::assoc_to_keyval($m_employees, 'id', 'emp_name');
		$this->template->set_global('employees', $employees, false);
	}
        
	//売上実績
	public function action_sales($project_id = null)
	{
		is_null($project_id) and Response::redirect('project');

		//案件データ
		if ( ! $project = Model_Project::find($project_id))
		{
			Session::set_flash('error', '該当の案件が見つかりません。 #'.$project_id);
			Response::redirect('project');
		}
		
		$data['project'] = $project;
		$data['project_id'] = $project_id;
		$data['temp_id'] = self::TEMP_ID;

		$this->template->title = "売上実績";
		$this->template->content = View::forge('project/sales', $data);
	}

	//売上実績削除
	public function action_sdelete($project_id = null, $result_id = null)
	{
		is_null($project_id) and Response::redirect('project');

		if ($project = Model_Sales_Result::find($result_id))
		{
			$project->delete();

			Session::set_flash('success', '売上実績情報を削除しました。 #'.$result_id);
		}
		else
		{
			Session::set_flash('error', '売上実績の削除に失敗しました。 #'.$result_id);
		}

		Response::redirect('project/sales/'.$project_id);
	}
}
