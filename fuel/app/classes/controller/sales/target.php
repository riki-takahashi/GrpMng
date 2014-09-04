<?php
/**
 * 売上目標コントローラクラス
 * Copyright 2014 Riki System Co.,Ltd.
 * @author i-suzuki
 */
class Controller_Sales_target extends Controller_Template {

    const LINE_PER_PAGE = 25; //ページネーション設定：１ページあたりの行数
    const PAGE = 'page';

    const ID = 'id';
    const GROUP_ID = 'group_id';
    const SALES_TERM_ID = 'sales_term_id';

    /**
     * beforeメソッドはTemplateを使用するために必要
     */
    public function before() {
        parent::before(); // この行がないと、テンプレートが動作しません!
    }

    /**
     * $response をパラメータとして追加し、after() を Controller_Template 互換にする
     */
    public function after($response) {
        $response = parent::after($response);
        return $response; // after() は確実に Response オブジェクトを返すように
    }

    /**
     * 案件検索（POST取得処理）
     */
    public function action_index() {
        //SESSION取得
        $group_id = Session::get($this::GROUP_ID);
        $sales_term_id = Session::get($this::SALES_TERM_ID);

        //検索条件構築
        //条件が指定されていなければ全件抽出
        $query = Model_Sales_Target::query();

        $query = Util::addAndCondition($query, $this::GROUP_ID, $group_id); //グループ
        $query = Util::addAndCondition($query, $this::SALES_TERM_ID, $sales_term_id); //売上期間
        //データ件数の取得
        $count = $query->count();

        //Paginationの環境設定
        $config = array(
            'pagination_url' => './',
            'uri_segment' => $this::PAGE,
            'num_links' => 2,
            'per_page' => $this::LINE_PER_PAGE,
            'total_items' => $count,
            'show_first' => true,
            'show_last' => true,
        );

        //Paginationのセット
        Pagination::set_config($config);

        //ビューに渡す配列の初期化
        $data = array();

        //モデルSales_Targetからページネーションデータを取得
        $data['sales_targets'] = $query
                ->order_by(array($this::GROUP_ID => 'asc', $this::SALES_TERM_ID => 'asc', 'id' => 'asc'))
                ->limit(Pagination::get('per_page'))
                ->offset(Pagination::get('offset'))
                ->get();

        //テンプレートファイルにデータの引き渡し
        $this->template->set_global($this::GROUP_ID, $group_id);
        $this->template->set_global($this::SALES_TERM_ID, $sales_term_id);
        $this->template->set_global($this::PAGE, Input::get($this::PAGE));
        $this->template->title = "売上目標一覧";
        $this->template->content = View::forge('sales/target/index', $data);
    }

    /**
     * 案件検索（POST取得処理）
     */
    public function get_search() {

        //SESSION取得
        $group_id = Session::get($this::GROUP_ID);
        $sales_term_id = Session::get($this::SALES_TERM_ID);

        //ビューに渡す配列の初期化
        $data = array();
        //ドロップダウン項目の設定
        $this->setDropDownList(true);

        //検索条件を保持
        $data[$this::GROUP_ID] = $group_id;
        $data[$this::SALES_TERM_ID] = $sales_term_id;

        //テンプレートファイルにデータの引き渡し
        $this->template->title = "売上目標検索";
        $this->template->content = View::forge('sales/target/search', $data);
    }

    /**
     * 案件検索（POST取得処理）
     */
    public function post_search() {
        $group_id = Input::post($this::GROUP_ID);
        $sales_term_id = Input::post($this::SALES_TERM_ID);

        //検索条件をセッションに保持
        Session::set($this::GROUP_ID, $group_id);
        Session::set($this::SALES_TERM_ID, $sales_term_id);

        Response::redirect('sales/target/index/');
    }

    /**
     * 新規登録
     * @param type $group_id
     * @param type $sales_term_id
     */
    public function action_create($group_id = null, $sales_term_id = null) {

        //POST処理
        if (Input::method() == 'POST') {
            $val = Model_Sales_Target::validate('create');

            if ($val->run()) {
                $sales_target = Model_Sales_Target::forge(array(
                              $this::GROUP_ID => Input::post($this::GROUP_ID)
                            , $this::SALES_TERM_ID => Input::post($this::SALES_TERM_ID)
                            , 'target_amount' => Input::post('target_amount')
                            , 'min_amount' => Input::post('min_amount')
                ));

                if ($sales_target and $sales_target->save()) {
                    Session::set_flash('success', '売上目標を追加しました。 #'.$sales_target->id.'.');
                    Response::redirect('sales/target/index'
                            .'?'.$this::GROUP_ID.'='.Input::post($this::GROUP_ID)
                            .'&'.$this::SALES_TERM_ID.'='.Input::post($this::SALES_TERM_ID));
                } else {
                    Session::set_flash('error', '売上目標の登録に失敗しました。');
                }
            } else {
                Session::set_flash('error', $val->error());
            }
        }

        //GET処理
        //新規作成時の初期表示用モデル作成
        $sales_target = Model_Sales_Target::forge(array(
              $this::GROUP_ID => $group_id
            , $this::SALES_TERM_ID => $sales_term_id
            , 'target_amount' => ''
            , 'min_amount' => ''
        ));
        
        //ドロップダウン項目の設定
        $this->setDropDownList();

        $this->template->set_global('sales_target', $sales_target, false);
        $this->template->set_global($this::GROUP_ID, $group_id);
        $this->template->set_global($this::SALES_TERM_ID, $sales_term_id);
        $this->template->title = "売上目標登録";
        $this->template->content = View::forge('sales/target/create');
    }

    /**
     * 編集（GET取得処理）
     */
    public function get_edit() {
    
        //GET処理
        $sales_target_id = Input::get($this::ID);
        $group_id = Input::get($this::GROUP_ID);
        $sales_term_id = Input::get($this::SALES_TERM_ID);
        $page = Input::get($this::PAGE);

        is_null($sales_target_id) and Response::redirect('sales/target/index'
                        .'?'.$this::GROUP_ID.'='.$group_id
                        .'&'.$this::SALES_TERM_ID.'='.$sales_term_id
                        .'&'.$this::PAGE.'='.$page);

        if (!$sales_target = Model_Sales_Target::find($sales_target_id)) {
            Session::set_flash('error', '該当の売上目標が見つかりません。 #'.$sales_target_id);
            Response::redirect('sales/target/index'
                    .'?'.$this::GROUP_ID.'='.$group_id
                    .'&'.$this::SALES_TERM_ID.'='.$sales_term_id
                    .'&'.$this::PAGE.'='.$page);
        }
        
        //ドロップダウン項目の設定
        $this->setDropDownList();

        $this->template->set_global('sales_target', $sales_target, false);
        $this->template->set_global($this::GROUP_ID, $group_id);
        $this->template->set_global($this::SALES_TERM_ID, $sales_term_id);
        $this->template->set_global($this::PAGE, $page);
        $this->template->title = "売上目標情報";
        $this->template->content = View::forge('sales/target/edit');
    }
    
    /**
     * 編集（POST取得処理）
     */
    public function post_edit() {    
        
        //POST処理
        $id = Input::post($this::ID);
        $group_id = Input::post($this::GROUP_ID);
        $sales_term_id = Input::post($this::SALES_TERM_ID);
        $page = Input::post($this::PAGE);        
        
        if (!$sales_target = Model_Sales_Target::find($id)) {
            Session::set_flash('error', '該当の売上目標が見つかりません。 #'.$id);
            
            Response::redirect('sales/target/index'
                    .'?'.$this::GROUP_ID.'='.$group_id
                    .'&'.$this::SALES_TERM_ID.'='.$sales_term_id
                    .'&'.$this::PAGE.'='.$page);
        }
        
        $val = Model_Sales_Target::validate('edit');

        if ($val->run()) {
            $sales_target->group_id = Input::post($this::GROUP_ID);
            $sales_target->sales_term_id = Input::post($this::SALES_TERM_ID);
            $sales_target->target_amount = Input::post('target_amount');
            $sales_target->min_amount = Input::post('min_amount');

            if ($sales_target->save()) {
                Session::set_flash('success', '売上目標を更新しました。 #'.$id);

                Response::redirect('sales/target/index'
                        .'?'.$this::GROUP_ID.'='.$group_id
                        .'&'.$this::SALES_TERM_ID.'='.$sales_term_id
                        .'&'.$this::PAGE.'='.$page);
            } else {
                Session::set_flash('error', '売上目標の更新に失敗しました。 #'.$id);
            }
        } else {
            if (Input::method() == 'POST') {
                $sales_target->id = $val->validated('id');
                $sales_target->group_id = $val->validated($this::GROUP_ID);
                $sales_target->sales_term_id = $val->validated($this::SALES_TERM_ID);
                $sales_target->target_amount = $val->validated('target_amount');
                $sales_target->min_amount = $val->validated('min_amount');

                Session::set_flash('error', $val->error());
            }

            $this->template->set_global('sales_target', $sales_target, false);
        }
        //ドロップダウン項目の設定
        $this->setDropDownList();

        $this->template->set_global($this::GROUP_ID, $group_id);
        $this->template->set_global($this::SALES_TERM_ID, $sales_term_id);
        $this->template->set_global($this::PAGE, $page);
        $this->template->title = "売上目標情報";
        $this->template->content = View::forge('sales/target/edit');
        
    }
    
    /**
     * 編集
     */    
    public function qq_action_edit() {

        //GET処理
        $sales_target_id = Input::get($this::ID);
        $group_id = Input::get($this::GROUP_ID);
        $sales_term_id = Input::get($this::SALES_TERM_ID);
        $page = Input::get($this::PAGE);

        is_null($sales_target_id) and Response::redirect('sales/target/index'
                        .'?'.$this::GROUP_ID.'='.$group_id
                        .'&'.$this::SALES_TERM_ID.'='.$sales_term_id
                        .'&'.$this::PAGE.'='.$page);

        if (!$sales_target = Model_Sales_Target::find($sales_target_id)) {
            Session::set_flash('error', '該当の売上目標が見つかりません。 #'.$sales_target_id);
            Response::redirect('sales/target/index'
                    .'?'.$this::GROUP_ID.'='.$group_id
                    .'&'.$this::SALES_TERM_ID.'='.$sales_term_id
                    .'&'.$this::PAGE.'='.$page);
        }

        $val = Model_Sales_Target::validate('edit');

        if ($val->run()) {
            $sales_target->group_id = Input::post($this::GROUP_ID);
            $sales_target->sales_term_id = Input::post($this::SALES_TERM_ID);
            $sales_target->target_amount = Input::post('target_amount');
            $sales_target->min_amount = Input::post('min_amount');

            if ($sales_target->save()) {
                Session::set_flash('success', '売上目標を更新しました。 #'.$sales_target_id);

                Response::redirect('sales/target/index'
                        .'?'.$this::GROUP_ID.'='.$group_id
                        .'&'.$this::SALES_TERM_ID.'='.$sales_term_id
                        .'&'.$this::PAGE.'='.$page);
            } else {
                Session::set_flash('error', '売上目標の更新に失敗しました。 #'.$sales_target_id);
            }
        } else {
            if (Input::method() == 'POST') {
                $sales_target->id = $val->validated('id');
                $sales_target->group_id = $val->validated($this::GROUP_ID);
                $sales_target->sales_term_id = $val->validated($this::SALES_TERM_ID);
                $sales_target->target_amount = $val->validated('target_amount');
                $sales_target->min_amount = $val->validated('min_amount');

                Session::set_flash('error', $val->error());
            }

            $this->template->set_global('sales_target', $sales_target, false);
        }
        //ドロップダウン項目の設定
        $this->setDropDownList();

        $this->template->set_global($this::GROUP_ID, $group_id);
        $this->template->set_global($this::SALES_TERM_ID, $sales_term_id);
        $this->template->set_global($this::PAGE, $page);
        $this->template->title = "売上目標情報";
        $this->template->content = View::forge('sales/target/edit');
    }

    /**
     * 削除
     */
    public function action_delete() {

        //GET処理
        $sales_target_id = Input::get($this::ID);
        $group_id = Input::get($this::GROUP_ID);
        $sales_term_id = Input::get($this::SALES_TERM_ID);

        is_null($sales_target_id) and Response::redirect('sales/target/index'
                        .'?'.$this::GROUP_ID.'='.$group_id
                        .'&'.$this::SALES_TERM_ID.'='.$sales_term_id);

        if ($sales_target = Model_Sales_Target::find($sales_target_id)) {
            $sales_target->delete();

            Session::set_flash('success', '売上目標を削除しました。 #'.$sales_target_id);
        } else {
            Session::set_flash('error', '売上目標の削除に失敗しました。 #'.$sales_target_id);
        }

        Response::redirect('sales/target/index'
                .'?'.$this::GROUP_ID.'='.$group_id
                .'&'.$this::SALES_TERM_ID.'='.$sales_term_id);
    }

    /**
     * ドロップダウンリスト設定
     * @param type $add_blank
     */
    private function setDropDownList($add_blank = false) {
        //グループ一覧
        $m_groups = Model_Group::find('all');
        $groups = Arr::assoc_to_keyval($m_groups, 'id', 'group_name');
        if ($add_blank == true) {
            //先頭にキーが0の空白行を追加する。
            //PHPでは連想配列のキーが数値の場合に、勝手に通常の配列に変換されてしまうため対策しました。
            $groups['0'] = '';
            ksort($groups);
        }
        $this->template->set_global('groups', $groups, false);

        //売上期間一覧
        $m_sales_terms = Model_Sales_Term::find('all');
        $sales_terms = Arr::assoc_to_keyval($m_sales_terms, 'id', 'term_name');
        if ($add_blank == true) {
            //先頭にキーが0の空白行を追加する。
            //PHPでは連想配列のキーが数値の場合に、勝手に通常の配列に変換されてしまうため対策しました。
            $sales_terms['0'] = '';
            ksort($sales_terms);
        }
        $this->template->set_global('sales_terms', $sales_terms, false);
    }

}
