<?php

/**
 * 売上ポイント集計（売上達成状況）コントローラクラス
 * Copyright 2014 Riki System Co.,Ltd.
 * @author i-suzuki
 */

class Controller_Sales_Achievement extends Controller_Template {

    const GROUP_ID = 'group_id';
    const SALES_TERM_ID = 'sales_term_id';
    const SALES_TARGET_ID = 'sales_target_id';
    
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
    
    public function action_index() {
        //GET処理
        $group_id = Input::get($this::GROUP_ID);
        $sales_term_id = Input::get($this::SALES_TERM_ID);

        //検索条件構築
        //条件が指定されていなければ全件抽出
        $query = Model_Sales_Target::query();

        $query = Util::addAndCondition($query, $this::GROUP_ID, $group_id); //グループ
        $query = Util::addAndCondition($query, $this::SALES_TERM_ID, $sales_term_id); //売上期間

        //データ件数の取得
        $count = $query->count();

        //ビューに渡す配列の初期化
        $data = array();

        //モデルSales_Targetからページネーションデータを取得
        $data['sales_targets'] = $query
                ->order_by(array($this::GROUP_ID => 'asc', $this::SALES_TERM_ID => 'asc', 'id' => 'asc'))
                ->get();

        //テンプレートファイルにデータの引き渡し
        $this->template->set_global($this::GROUP_ID, $group_id);
        $this->template->set_global($this::SALES_TERM_ID, $sales_term_id);
        $this->template->title = "売上達成状況一覧";
        $this->template->content = View::forge('sales\achievement/index', $data);
    }
    
    public function get_search() {

        //GET処理
        $group_id = Input::get($this::GROUP_ID);
        $sales_term_id = Input::get($this::SALES_TERM_ID);

        //ビューに渡す配列の初期化
        $data = array();
        //ドロップダウン項目の設定
        $this->setDropDownList(true);

        $this->template->set_global($this::GROUP_ID, $group_id);
        $this->template->set_global($this::SALES_TERM_ID, $sales_term_id);

        //検索条件を保持
        $data[$this::GROUP_ID] = $group_id;
        $data[$this::SALES_TERM_ID] = $sales_term_id;

        //テンプレートファイルにデータの引き渡し
        $this->template->title = "売上達成状況検索";
        $this->template->content = View::forge('sales\achievement/search', $data);
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
            
            Response::redirect('sales/achievement/index');
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
