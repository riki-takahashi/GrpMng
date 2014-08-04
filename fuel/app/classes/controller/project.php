<?php

/**
 * 案件情報コントローラクラス
 * Copyright 2014 Riki System Co.,Ltd.
 */
class Controller_Project extends Controller_Mybase {

    const PROJECT = 'project';
    const PROJECT_NAME = 'project_name';
    const GROUP_ID = 'group_id';
    const EMP_ID = 'emp_id';
    const PAGE = 'page';

    /** 新規作成時の一時的なID */
    const TEMP_ID = 99999;

    /**
     * beforeメソッドはTemplateを使用するために必要
     */
    public function before() {
        parent::before(); // この行がないと、テンプレートが動作しません!
    }

    /**
     * テンプレート使用のための後処理
     * $response をパラメータとして追加し、after() を Controller_Template 互換にする
     */
    public function after($response) {
        $response = parent::after($response);
        return $response; // after() は確実に Response オブジェクトを返すように
    }

    /**
     * 案件一覧
     * @param type $project_name
     * @param type $group_id
     */
    public function action_index() {
        //SESSION取得処理
        $project = Session::get($this::PROJECT);
        
        $project_name = $project->project_name;
        $group_id = $project->group_id;
        $emp_id = $project->emp_id;

        //検索条件構築
        //条件が指定されていなければ全件抽出
        $query = Model_Project::query();
        $query = Util::addAndCondition($query, $this::GROUP_ID, $group_id); //グループ
        $query = Util::addAndCondition($query, $this::EMP_ID, $emp_id); //担当者

        //データ件数の取得
        $count = $query->count();
        
        //Paginationの環境設定
        $config = array(
            'pagination_url' => './',
            'uri_segment' => $this::PAGE,
            'num_links' => 2,
            'per_page' => 4,
            'total_items' => $count,
            'show_first' => true,
            'show_last' => true,
        );

        //Paginationのセット
        Pagination::set_config($config);

        //ビューに渡す配列の初期化
        $data = array();

        //案件一覧データ取得（ページネーション）
        $data['projects'] = $query
                ->order_by(array($this::GROUP_ID => 'asc', $this::EMP_ID => 'asc', 'id' => 'asc'))
                ->limit(Pagination::get('per_page'))
                ->offset(Pagination::get('offset'))
                ->get();

        //テンプレートファイルにデータの引き渡し
        $this->template->set_global($this::GROUP_ID, $group_id);
        $this->template->set_global($this::EMP_ID, $emp_id);
        $this->template->set_global($this::PAGE, Input::get($this::PAGE));

        $this->template->title = "案件一覧";
        $this->template->content = View::forge('project/index', $data);
    }

    /**
     * 案件検索（GET取得処理）
     */
    public function get_search() {

        //ドロップダウン項目の設定
        $this->setDropDownList(true);

        //SESSION取得処理
        $project = Session::get($this::PROJECT);

        //Fieldsetの定義
        $fieldset = Fieldset::forge();

        $flg = false;

        //初期値設定
        if ($project) {
            $flg = true;
        } else {
            $project = Model_Project::forge();
        }

        $fieldset->add_model($project);

        //担当グループドロップダウン設定（データベースから読み取り）
        $fieldset->field('group_id')->set_options($this->getGroups(true));

        //担当者ドロップダウン設定（データベースから読み取り）
        $fieldset->field('emp_id')->set_options($this->getEmployees(true));

        //SESSIONからの引継ぎデータがあれば、それを反映
        if ($flg) {
            $fieldset->populate($project);
        }
        $this->template->set_global('fieldset', $fieldset, false);

        //テンプレートファイルにデータの引き渡し
        $this->template->title = "案件検索";
        $this->template->content = View::forge('project/search');
    }

    /**
     * 案件検索（POST取得処理）
     */
    public function post_search() {
        $project_name = Input::post($this::PROJECT_NAME);
        $group_id = Input::post($this::GROUP_ID);
        $emp_id = Input::post($this::EMP_ID);

        $project = Model_Project::forge();
        $project->project_name = $project_name;
        $project->group_id = $group_id;
        $project->emp_id = $emp_id;

        Session::set($this::PROJECT, $project);

        // バリデーションチェック
        $fieldset = Fieldset::forge();
        $val = $fieldset->validation();
        if ($val->run()) {

            $project_name = Input::post('project_name');
            $start_date_from = Input::post('project_name');
            $start_date_to = Input::post('project_name');

            $this->action_index();
            Response::redirect('project/index/'.$group_id.'/'.$emp_id.'/');
        } else {
            $fieldset->repopulate();
        }
    }

    /**
     * 案件情報新規追加
     */
    public function action_create() {
        if (Input::method() == 'POST') {
            $val = Model_Project::validate('create');

            if ($val->run()) {
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

                if ($project and $project->save()) {
                    Session::set_flash('success', '案件を追加しました。 #'.$project->id.'.');

                    Response::redirect('project');
                } else {
                    Session::set_flash('error', '案件情報の登録に失敗しました。');
                }
            } else {
                Session::set_flash('error', $val->error());
            }
        }
        //ドロップダウン項目の設定
        $this->setDropDownList();

        $this->template->title = "案件登録";
        $this->template->content = View::forge('project/create');
    }

    /**
     * 案件情報編集
     * @param type $project_id
     */
    public function action_edit($project_id = null) {
        is_null($project_id) and Response::redirect('project');

        if (!$project = Model_Project::find($project_id)) {
            Session::set_flash('error', '該当の案件が見つかりません。 #'.$project_id);
            Response::redirect('project');
        }

        $val = Model_Project::validate('edit');

        if ($val->run()) {
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

            if ($project->save()) {
                Session::set_flash('success', '案件情報を更新しました。 #'.$project_id);

                Response::redirect('project');
            } else {
                Session::set_flash('error', '案件情報の更新に失敗しました。 #'.$project_id);
            }
        } else {
            if (Input::method() == 'POST') {
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

    /**
     * 案件情報削除
     * @param type $project_id
     */
    public function action_delete($project_id = null) {
        is_null($project_id) and Response::redirect('project');

        if ($project = Model_Project::find($project_id)) {
            $project->delete();

            Session::set_flash('success', '案件情報を削除しました。 #'.$project_id);
        } else {
            Session::set_flash('error', '案件情報の削除に失敗しました。 #'.$project_id);
        }

        Response::redirect('project');
    }

    /**
     * 案件メンバー
     * @param type $project_id
     * @param type $member_id
     */
    public function action_member($project_id = null, $member_id = null) {
        is_null($project_id) and Response::redirect('project');

        //案件データ
        if (!$project = Model_Project::find($project_id)) {
            Session::set_flash('error', '該当の案件が見つかりません。 #'.$project_id);
            Response::redirect('project');
        }

        if (Input::method() == 'POST') {
            $val = Model_Projectmember::validate('edit');

            if ($val->run()) {
                if ($member = Model_Projectmember::find($member_id)) {
                    //更新処理
                    $member->start_date = Input::post('start_date');
                    $member->end_date = Input::post('end_date');
                    $member->note = Util::empty_to_null(Input::post('note'));

                    if ($member->save()) {
                        Session::set_flash('success', 'メンバー情報を更新しました。 #'.$member_id);

                        Response::redirect('project/member/'.$project->id);
                    }
                }
            } else {
                Session::set_flash('error', $val->error());
            }
        }

        $data['project'] = $project;
        $data['member_id'] = $member_id;
        $data['temp_id'] = self::TEMP_ID;

        $this->template->title = "案件メンバー登録";
        $this->template->content = View::forge('project/member', $data);
    }

    /**
     * 案件メンバー追加
     * @param type $project_id
     */
    public function action_mcreate($project_id = null) {
        is_null($project_id) and Response::redirect('project');

        //案件データ
        if (!$project = Model_Project::find($project_id)) {
            Session::set_flash('error', '該当の案件が見つかりません。 #'.$project_id);
            Response::redirect('project');
        }

        if (Input::method() == 'POST') {
            $val = Model_Projectmember::validate('edit');

            if ($val->run()) {
                $member = Model_Projectmember::forge(array(
                            'project_id' => $project_id,
                            'emp_id' => Input::post('emp_id'),
                            'start_date' => Input::post('start_date'),
                            'end_date' => Input::post('end_date'),
                            'note' => Util::empty_to_null(Input::post('note')),
                ));
                if ($member->save()) {
                    Session::set_flash('success', 'メンバー情報を追加しました。 #'.$member->id);

                    Response::redirect('project/member/'.$project->id);
                }
            } else {
                Session::set_flash('error', $val->error());
            }
        } else {
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

    /**
     * 案件メンバー削除
     * @param type $project_id
     * @param type $member_id
     */
    public function action_mdelete($project_id = null, $member_id = null) {
        is_null($member_id) and Response::redirect('project');

        if ($member = Model_Projectmember::find($member_id)) {
            $member->delete();

            Session::set_flash('success', '案件メンバー情報を削除しました。 #'.$member_id);
        } else {
            Session::set_flash('error', '案件メンバーの削除に失敗しました。 #'.$member_id);
        }

        Response::redirect('project/member/'.$project_id);
    }

    /**
     * グループ一覧取得
     * @param type $add_blank
     * @return type
     */
    private function getGroups($add_blank = false) {
        $m_groups = Model_Group::find('all');
        $groups = Arr::assoc_to_keyval($m_groups, 'id', 'group_name');
        if ($add_blank == true) {
            Arr::insert_assoc($groups, array(""), 0);
        }
        return $groups;
    }

    /**
     * 物件担当一覧取得
     * @param type $add_blank
     * @return type
     */
    private function getEmployees($add_blank = false) {
        $m_employees = Model_Employee::find('all', array(
                    'where' => array(
                        array('is_mng_flag', '1'),
                    ),
                    'order_by' => array('emp_kana' => 'asc'),
        ));
        $employees = Arr::assoc_to_keyval($m_employees, 'id', 'emp_name');
        if ($add_blank == true) {
            Arr::insert_assoc($employees, array(""), 0);
        }
        return $employees;
    }

    /**
     * ドロップダウンリスト設定（グループ一覧、物件担当一覧）
     * @param type $add_blank
     */
    private function setDropDownList($add_blank = false) {
        //グループ一覧
        $this->template->set_global('groups', $this->getGroups($add_blank), false);

        //物件担当一覧
        $this->template->set_global('employees', $this->getEmployees($add_blank), false);
    }

    /**
     * ドロップダウンリスト設定（社員一覧）
     */
    private function setMemberDropDown() {
        $m_employees = Model_Employee::find('all', array(
                    'where' => array(
                        array('invalid_flag', '0'),
                    ),
                    'order_by' => array('emp_kana' => 'asc'),
        ));
        $employees = Arr::assoc_to_keyval($m_employees, 'id', 'emp_name');
        $this->template->set_global('employees', $employees, false);
    }

    /**
     * 売上実績 
     * @param type $project_id
     */
    public function action_sales($project_id = null) {
        is_null($project_id) and Response::redirect('project');

        //案件データ
        if (!$project = Model_Project::find($project_id)) {
            Session::set_flash('error', '該当の案件が見つかりません。 #'.$project_id);
            Response::redirect('project');
        }

        $data['project'] = $project;
        $data['project_id'] = $project_id;
        $data['temp_id'] = self::TEMP_ID;

        $this->template->title = "売上実績";
        $this->template->content = View::forge('project/sales', $data);
    }

    /**
     * 売上実績削除
     * @param type $project_id
     * @param type $result_id
     */
    public function action_sdelete($project_id = null, $result_id = null) {
        is_null($project_id) and Response::redirect('project');

        if ($project = Model_Sales_Result::find($result_id)) {
            $project->delete();

            Session::set_flash('success', '売上実績情報を削除しました。 #'.$result_id);
        } else {
            Session::set_flash('error', '売上実績の削除に失敗しました。 #'.$result_id);
        }

        Response::redirect('project/sales/'.$project_id);
    }

}
