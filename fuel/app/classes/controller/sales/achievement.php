<?php
/**
 * 売上集計コントローラクラス
 * Copyright 2014 Riki System Co.,Ltd.
 * @author i-suzuki
 */
class Controller_Sales_Achievement extends Controller_Template {

    const AGGREGATE_UNIT_ID = 'aggregate_unit_id'; //集計単位ID
    const SALES_TERM_ID = 'sales_term_id'; //売上期間ID
    const PDF_OUT_FLG = 'pdf_out_flg'; //PDF出力フラグ

    /**
     * beforeメソッドはTemplateを使用するために必要
     */
    public function before() {
        parent::before(); // この行がないと、テンプレートが動作しません!
    }

    /**
     * $response をパラメータとして追加し、after() を Controller_Template 互換にする
     * @param type $response
     * @return type
     */
    public function after($response) {
        $response = parent::after($response);
        return $response; // after() は確実に Response オブジェクトを返すように
    }

    /**
     * 集計結果表示
     */
    public function action_index() {

        //GET取得
        $aggregate_unit_id = Input::get($this::AGGREGATE_UNIT_ID); //集計単位ID
        $sales_term_id = Input::get($this::SALES_TERM_ID); //売上期間ID
        $pdf_out_flg = Input::get($this::PDF_OUT_FLG); //PDF出力フラグ
        
        $data = array();

        if ($aggregate_unit_id == 0 or $sales_term_id == 0){
            Session::set_flash('error', '売上期間と集計単位を入力してください。');
            $this->template->title = "売上集計";
            $this->template->content = View::forge('sales/achievement/index', $data); //ビュー生成
            return;
        }
        
        $sales_term = Model_Sales_Term::find($sales_term_id); //売上期間名
        //検索条件構築
        $sales_total = array();

        //集計単位毎に処理を分けています
        if ($aggregate_unit_id == '1') {
            $sales_total['1'] = Array('title' => '', 'list' => $this->make_sum_for_all($sales_term_id));
        }

        if ($aggregate_unit_id == '2') {
            $sales_total['1'] = Array('title' => '', 'list' => $this->make_sum_for_group($sales_term_id));
        }

        if ($aggregate_unit_id == '3') {
            $sales_total = $this->make_sum_for_employee($sales_term_id);
        }

        //ビューに渡す配列の初期化
        $data['sales_total'] = $sales_total;

        //テンプレートファイルにデータの引き渡し
        $this->template->set_global($this::AGGREGATE_UNIT_ID, $aggregate_unit_id); //集計単位ID
        $this->template->set_global($this::SALES_TERM_ID, $sales_term_id); //売上期間ID
        $this->template->set_global('term_name', $sales_term->term_name); //売上期間名
        $this->template->set_global($this::PDF_OUT_FLG, $pdf_out_flg); //PDF出力フラグ
        $this->template->title = "売上集計";
        $this->template->content = View::forge('sales/achievement/index', $data); //ビュー生成
    }

    /**
     * 集計結果取得（全体）
     * @param int $sales_term_id 対象期間ID
     * @return array １行分の集計結果
     */
    private function make_sum_for_all($sales_term_id = null) {

        //結果の初期化
        $sales_total = array('row_title' => '全体', 'target_amount_sum' => '', 'sales_amount_sum' => '', 'order_amount_sum' => '', 'min_amount_sum' => '');

        //対象期間を取得
        $queryA = DB::select('id', 'start_date', 'end_date')
                ->from('sales_terms')
                ->where('id', $sales_term_id);

        $sales_terms = $queryA
                ->execute()
                ->as_array();

        //指定されたIDで目標金額と最低金額を集計する。　また、対象期間で、実績金額と見込金額を集計する
        foreach ($sales_terms as $sales_term) {

            //目標金額
            $queryB = DB::select(
                            array(DB::expr('sum(target_amount)'), 'target_amount_sum'), array(DB::expr('sum(min_amount)'), 'min_amount_sum')
                    )
                    ->from('sales_targets')
                    ->where('sales_term_id', $sales_term['id']);

            $sales_targets = $queryB
                    ->execute()
                    ->as_array();

            //１件あれば反映する
            foreach ($sales_targets as $sales_target) {
                $sales_total['target_amount_sum'] = $sales_target['target_amount_sum'];
                $sales_total['min_amount_sum'] = $sales_target['min_amount_sum'];
            }

            //実績金額
            $queryC = DB::select(array(DB::expr('sum(sales_amount)'), 'sales_amount_sum'))
                    ->from('sales_results')
                    ->where('sales_date', 'BETWEEN', array($sales_term['start_date'].' 00:00:00', $sales_term['end_date'].' 23:59:59'));

            $sales_results = $queryC
                    ->execute()
                    ->as_array();

            //１件あれば反映する
            foreach ($sales_results as $sales_result) {
                $sales_total['sales_amount_sum'] = $sales_result['sales_amount_sum'];
            }

            //見込金額
            $queryD = DB::select(array(DB::expr('sum(order_amount)'), 'order_amount_sum'))
                    ->from('projects')
                    ->where('sales_date', 'BETWEEN', array($sales_term['start_date'].' 00:00:00', $sales_term['end_date'].' 23:59:59'));

            $projects = $queryD
                    ->execute()
                    ->as_array();

            //１件あれば反映する
            foreach ($projects as $project) {
                $sales_total['order_amount_sum'] = $project['order_amount_sum'];
            }
        }

        return array('0' => $sales_total);
    }

    /**
     * 集計結果取得（グループ別）
     * @param int $sales_term_id 対象期間ID
     */
    private function make_sum_for_group($sales_term_id = null) {

        //グループ毎の売上目標
        $queryT1 = DB::select(DB::expr('A.start_date, A.end_date, C.group_id, C.id, C.emp_id, H.group_name AS row_title, sum(B.target_amount) AS target_amount_sum, sum(B.min_amount) AS min_amount_sum'))
                ->from(array('sales_terms', 'A'))
                //売上目標情報
                ->join(array('sales_targets', 'B'), 'INNER')
                ->on('A.id', '=', 'B.sales_term_id')
                //案件情報
                ->join(array('projects', 'C'), 'LEFT OUTER')
                ->on('C.id', '=', 'B.group_id')
                //グループマスタ
                ->join(array('groups', 'H'), 'LEFT OUTER')
                ->on('H.id', '=', 'C.group_id')
                ->where('A.id', $sales_term_id)
                ->group_by('C.id', 'C.group_id');

        //売上実績情報
        $queryD = DB::select(DB::expr('project_id, max(sales_date) as sales_date_max, sum(sales_amount) as sales_amount_sum'))
                ->from('sales_results')
                ->group_by('project_id');

        //担当社員別集計
        $query = DB::select(DB::expr('T1.group_id, T1.emp_id, T1.row_title, T1.target_amount_sum, D.sales_amount_sum, sum(K.order_amount) AS order_amount_sum, T1.min_amount_sum'))
                //売上対象期間情報
                ->from(array($queryT1, 'T1'))
                //売上実績情報（実績金額 集計のため、売上金額を抽出）
                ->join(array($queryD, 'D'), 'LEFT OUTER')
                ->on('D.project_id', '=', 'T1.id')
                //案件情報（見込金額 集計のため、受注金額を抽出）
                ->join(array('projects', 'K'), 'LEFT OUTER')
                ->on('K.group_id', '=', 'T1.group_id')
                ->and_on('K.emp_id', '=', 'T1.emp_id')
                ->where(DB::expr('(D.sales_date_max BETWEEN T1.start_date AND T1.end_date)'))
                ->and_where(DB::expr('(K.sales_date BETWEEN T1.start_date AND T1.end_date)'))
                ->group_by('T1.group_id')
                ->order_by('T1.id', 'asc')
                ->order_by('T1.group_id', 'asc');

        $sales_total = $query
                ->execute()
                ->as_array();

        //小計行追加
        $row_sum = array('row_title' => '小計', 'target_amount_sum' => 0, 'sales_amount_sum' => 0, 'order_amount_sum' => 0, 'min_amount_sum' => 0);
        foreach($sales_total as $total){
            $row_sum['target_amount_sum'] += $total['target_amount_sum'];
            $row_sum['sales_amount_sum'] += $total['sales_amount_sum'];
            $row_sum['order_amount_sum'] += $total['order_amount_sum'];
            $row_sum['min_amount_sum'] += $total['min_amount_sum'];
        }
        $sales_total[] = $row_sum;
        
        return $sales_total;
    }

    /**
     * 集計結果取得（担当社員別）
     * @param int $sales_term_id 対象期間ID
     */
    private function make_sum_for_employee($sales_term_id = null) {

        //全グループを取得
        $query = DB::select('id', 'group_name')
                ->from('groups');

        $groups = $query
                ->execute()
                ->as_array();

        //指定された対象期間で、グループ毎に集計する
        foreach ($groups as $group) {

            $queryT1 = DB::select(DB::expr('A.start_date, A.end_date, C.group_id, C.id, C.emp_id, H.emp_name AS row_title, sum(B.target_amount) AS target_amount_sum, sum(B.min_amount) AS min_amount_sum'))
                    ->from(array('sales_terms', 'A'))
                    //売上目標情報
                    ->join(array('sales_targets', 'B'), 'INNER')
                    ->on('A.id', '=', 'B.sales_term_id')
                    //案件情報
                    ->join(array('projects', 'C'), 'LEFT OUTER')
                    ->on('C.id', '=', 'B.group_id')
                    //社員マスタ
                    ->join(array('employees', 'H'), 'LEFT OUTER')
                    ->on('H.id', '=', 'C.emp_id')
                    ->where('A.id', $sales_term_id)
                    ->group_by('C.id');

            //売上実績情報
            $queryD = DB::select(DB::expr('project_id, max(sales_date) as sales_date_max, sum(sales_amount) as sales_amount_sum'))
                    ->from('sales_results')
                    ->group_by('project_id');

            //担当社員別集計
            $query = DB::select(DB::expr('T1.group_id, T1.emp_id, T1.row_title, T1.target_amount_sum, D.sales_amount_sum, sum(K.order_amount) AS order_amount_sum, T1.min_amount_sum'))

                    //売上対象期間情報
                    ->from(array($queryT1, 'T1'))
                    //売上実績情報（実績金額 集計のため、売上金額を抽出）
                    ->join(array($queryD, 'D'), 'LEFT OUTER')
                    ->on('D.project_id', '=', 'T1.id')
                    //案件情報（見込金額 集計のため、受注金額を抽出）
                    ->join(array('projects', 'K'), 'LEFT OUTER')
                    ->on('K.group_id', '=', 'T1.group_id')
                    ->and_on('K.emp_id', '=', 'T1.emp_id')
                    ->where(DB::expr('(D.sales_date_max BETWEEN T1.start_date AND T1.end_date)'))
                    ->and_where(DB::expr('(K.sales_date BETWEEN T1.start_date AND T1.end_date)'))
                    ->and_where('T1.group_id', $group['id'])
                    ->group_by('T1.id', 'T1.group_id')
                    ->order_by('T1.id', 'asc')
                    ->order_by('T1.group_id', 'asc');

            //Session::set_flash('success', 'クエリー内容: '.$queryT1->__toString());        
            
            $tabledata = $query
                    ->execute()
                    ->as_array();

            //小計行追加
            $row_sum = array('row_title' => '小計', 'target_amount_sum' => 0, 'sales_amount_sum' => 0, 'order_amount_sum' => 0, 'min_amount_sum' => 0);
            foreach($tabledata as $each_row){
                $row_sum['target_amount_sum'] += $each_row['target_amount_sum'];
                $row_sum['sales_amount_sum'] += $each_row['sales_amount_sum'];
                $row_sum['order_amount_sum'] += $each_row['order_amount_sum'];
                $row_sum['min_amount_sum'] += $each_row['min_amount_sum'];
            }
            $tabledata[] = $row_sum;
            
            //グループ毎にデータを取得、設定
            $sales_total[$group['id']] = Array('title' => $group["group_name"], 'list' => $tabledata);
        }

        return $sales_total;
    }

    /**
     * セッションから検索条件を取得
     */
    public function get_search() {

        //SESSION取得処理
        $aggregate_unit_id = Session::get($this::AGGREGATE_UNIT_ID); //集計単位ID
        $sales_term_id = Session::get($this::SALES_TERM_ID); //売上期間ID
        //ビューに渡す配列の初期化
        $data = array();
        //ドロップダウン項目の設定
        $this->setDropDownList(true);

        $this->template->set_global($this::AGGREGATE_UNIT_ID, $aggregate_unit_id); //集計単位ID
        $this->template->set_global($this::SALES_TERM_ID, $sales_term_id); //売上期間ID

        //検索条件を保持
        $data[$this::AGGREGATE_UNIT_ID] = $aggregate_unit_id; //集計単位ID
        $data[$this::SALES_TERM_ID] = $sales_term_id; //売上期間ID

        //テンプレートファイルにデータの引き渡し
        $this->template->title = "売上集計";
        $this->template->content = View::forge('sales/achievement/search', $data);
    }

    /**
     * 案件検索（POST取得処理）
     */
    public function post_search() {
        //POST取得
        $aggregate_unit_id = Input::post($this::AGGREGATE_UNIT_ID); //集計単位ID
        $sales_term_id = Input::post($this::SALES_TERM_ID); //売上期間ID

        $data = array();
        
        //ドロップダウン項目の設定
        $this->setDropDownList(true);

        $this->template->set_global($this::AGGREGATE_UNIT_ID, $aggregate_unit_id); //集計単位ID
        $this->template->set_global($this::SALES_TERM_ID, $sales_term_id); //売上期間ID
        
        if ($aggregate_unit_id == 0 or $sales_term_id == 0){
            Session::set_flash('error', '売上期間と集計単位を入力してください。');
            $this->template->title = "売上集計";
            $this->template->content = View::forge('sales/achievement/search', $data); //ビュー生成
            return;
        }

        //検索条件をセッションに保持
        Session::set($this::AGGREGATE_UNIT_ID, $aggregate_unit_id); //集計単位ID
        Session::set($this::SALES_TERM_ID, $sales_term_id); //売上期間ID

        Response::redirect('sales/achievement/index?aggregate_unit_id='.$aggregate_unit_id.'&sales_term_id='.$sales_term_id);
    }

    /**
     * ドロップダウンリスト設定
     * @param type $add_blank
     */
    private function setDropDownList($add_blank = false) {
        //集計単位一覧
        $aggregate_units = Array('1' => '全体', '2' => 'グループ別', '3' => '担当社員別');
        if ($add_blank == true) {
            //先頭にキーが0の空白行を追加する。
            //PHPでは連想配列のキーが数値の場合に、勝手に通常の配列に変換されてしまうため対策しました。
            $aggregate_units['0'] = '';
            ksort($aggregate_units);
        }
        $this->template->set_global('aggregate_units', $aggregate_units, false);

        //売上期間一覧
        $m_sales_terms = Model_Sales_Term::find('all', array(
                    'order_by' => array('start_date' => 'asc', 'end_date' => 'asc', 'id' => 'asc'),
        ));
        $sales_terms = Arr::assoc_to_keyval($m_sales_terms, 'id', 'term_name');
        if ($add_blank == true) {
            //先頭にキーが0の空白行を追加する。
            //PHPでは連想配列のキーが数値の場合に、勝手に通常の配列に変換されてしまうため対策しました。
            $sales_terms['0'] = '';
            ksort($sales_terms);
        }
        $this->template->set_global('sales_terms', $sales_terms, false);
    }
    
    /*
     * 売上集計結果PDF出力
     */
    public function action_pdf() {
        
        //GET取得
        $aggregate_unit_id = Input::get($this::AGGREGATE_UNIT_ID); //集計単位ID
        $sales_term_id = Input::get($this::SALES_TERM_ID); //売上期間ID
        $pdf_out_flg = Input::get($this::PDF_OUT_FLG); //PDF出力フラグ

        //ini_set('memory_limit', '256M'); //実行時にメモリ不足になるなら、左記のコメントを削除して有効にする。
        $html = file_get_contents(Uri::base(false)
                .'sales/achievement/index?'
                .$this::AGGREGATE_UNIT_ID.'='.$aggregate_unit_id
                .'&'.$this::SALES_TERM_ID.'='.$sales_term_id
                .'&'.$this::PDF_OUT_FLG.'='.$pdf_out_flg);
        
        //mPDFはFuelPFPのフレームワークを意識したつくりになっていないため、BootstrapのAutoLoaderを使用しないでインクルードする。
        require_once(APPPATH.'../packages/mpdf/mpdf.php');
        $mpdf = new mPDF('ja', 'A4');
        $mpdf->WriteHTML($html);
        $mpdf->Output('売上集計結果.pdf', 'I');
    }
    
}
