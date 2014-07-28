<?php

class Controller_Sales_target extends Controller_Template {

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

    public function action_index() {
        //ビューに渡す配列の初期化
        $data = array();

        // カテゴリ1の総数を取得する。
        $query = Model_Sales_Target::query()->where('group_id', 1);
        $total_items = $query->count();

        //データ件数の取得
        $count = $query->count();

        //Paginationの環境設定
        $config = array(
            'pagination_url' => 'GrpMng/sales/target/index',
            'uri_segment' => 4,
            'num_links' => 4,
            'per_page' => 5,
            'total_items' => $count,
            //'name' => 'bootstrap3',
            //'wrapper' => '<ul class="pagination pagination-centered">{pagination}</ul>',
            'show_first' => true,
            'show_last' => true,
        );

        //Paginationのセット
        Pagination::set_config($config);

        //モデルSales_Targetからページネーションデータを取得
        $data['sales_targets'] = $query
                ->order_by(array('group_id' => 'asc', 'sales_term_id' => 'asc', 'id' => 'asc'))
                ->limit(Pagination::get('per_page'))
                ->offset(Pagination::get('offset'))
                ->get();

        //テンプレートファイルにデータの引き渡し
        $this->template->title = "売上目標一覧";
        $this->template->content = View::forge('sales\target/index', $data);
    }

    public function action_create() {
        if (Input::method() == 'POST') {
            $val = Model_Sales_Target::validate('create');

            if ($val->run()) {
                $sales_target = Model_Sales_Target::forge(array(
                            'id' => Input::post('id'),
                            'group_id' => Input::post('group_id'),
                            'sales_term_id' => Input::post('sales_term_id'),
                            'target_amount' => Input::post('target_amount'),
                            'min_amount' => Input::post('min_amount'),
                ));

                if ($sales_target and $sales_target->save()) {
                    Session::set_flash('success', '売上目標を追加しました。 #' . $sales_target->id . '.');

                    Response::redirect('sales/target');
                } else {
                    Session::set_flash('error', '売上目標の登録に失敗しました。');
                }
            } else {
                Session::set_flash('error', $val->error());
            }
        }
        //ドロップダウン項目の設定
        $this->setDropDownList();

        $this->template->title = "売上目標登録";
        $this->template->content = View::forge('sales\target/create');
    }

    public function action_edit($sales_target_id = null) {
        is_null($sales_target_id) and Response::redirect('sales/target');

        if (!$sales_target = Model_Sales_Target::find($sales_target_id)) {
            Session::set_flash('error', '該当の売上目標が見つかりません。 #' . $sales_target_id);
            Response::redirect('sales/target');
        }

        $val = Model_Sales_Target::validate('edit');

        if ($val->run()) {
            $sales_target->group_id = Input::post('group_id');
            $sales_target->sales_term_id = Input::post('sales_term_id');
            $sales_target->target_amount = Input::post('target_amount');
            $sales_target->min_amount = Input::post('min_amount');

            if ($sales_target->save()) {
                Session::set_flash('success', '売上目標を更新しました。 #' . $sales_target_id);

                Response::redirect('sales/target');
            } else {
                Session::set_flash('error', '売上目標の更新に失敗しました。 #' . $sales_target_id);
            }
        } else {
            if (Input::method() == 'POST') {
                $sales_target->id = $val->validated('id');
                $sales_target->group_id = $val->validated('group_id');
                $sales_target->sales_term_id = $val->validated('sales_term_id');
                $sales_target->target_amount = $val->validated('target_amount');
                $sales_target->min_amount = $val->validated('min_amount');

                Session::set_flash('error', $val->error());
            }

            $this->template->set_global('sales_target', $sales_target, false);
        }
        //ドロップダウン項目の設定
        $this->setDropDownList();

        $this->template->title = "売上目標情報";
        $this->template->content = View::forge('sales\target/edit');
    }

    public function action_delete($sales_target_id = null) {
        is_null($sales_target_id) and Response::redirect('sales/target');

        if ($sales_target = Model_Sales_Target::find($sales_target_id)) {
            $sales_target->delete();

            Session::set_flash('success', '売上目標を削除しました。 #' . $sales_target_id);
        } else {
            Session::set_flash('error', '売上目標の削除に失敗しました。 #' . $sales_target_id);
        }

        Response::redirect('sales/target');
    }

    private function setDropDownList() {
        //グループ一覧
        $m_groups = Model_Group::find('all');
        $groups = Arr::assoc_to_keyval($m_groups, 'id', 'group_name');
        $this->template->set_global('groups', $groups, false);

        //売上期間一覧
        $m_sales_terms = Model_Sales_Term::find('all');
        $sales_terms = Arr::assoc_to_keyval($m_sales_terms, 'id', 'term_name');
        $this->template->set_global('sales_terms', $sales_terms, false);
    }

}
