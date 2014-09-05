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
    const TARGET_OUT_FLG = 'taget_out_flg'; //目標金額、最低金額の表示フラグ

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
            $this->template->set_global($this::TARGET_OUT_FLG, 'true'); //目標金額、最低金額の表示フラグ
        }

        if ($aggregate_unit_id == '2') {
            $sales_total['1'] = Array('title' => '', 'list' => $this->make_sum_for_group($sales_term_id));
            $this->template->set_global($this::TARGET_OUT_FLG, 'true'); //目標金額、最低金額の表示フラグ
        }

        if ($aggregate_unit_id == '3') {
            $sales_total = $this->make_sum_for_employee($sales_term_id);
            $this->template->set_global($this::TARGET_OUT_FLG, null); //目標金額、最低金額の表示フラグ
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

        //グループ毎の集計
        $query = DB::select(DB::expr("
            '全体' as row_title, T1.target_amount_sum, T2.sales_amount_sum, T3.order_amount_sum, T1.min_amount_sum
            from (
                    SELECT 
                            Z.id as id, 
                            sum(Z.target_amount) as target_amount_sum, /*　１．売上目標金額　*/
                            sum(Z.min_amount) as min_amount_sum, /*　４．売上最低金額　*/
                            Z.start_date,
                            Z.end_date
                    from (
                            select
                                    A.id, 
                                    A.start_date,
                                    A.end_date,
                                    B.target_amount, 
                                    B.min_amount
                            from sales_terms as A
                            left outer join sales_targets as B
                            on (B.sales_term_id = A.id)
                            where 
                            A.id = ".$sales_term_id."
                    ) AS Z
            ) T1

            left outer join (
                    select A.id,
                    sum(R.sales_amount_sum) as sales_amount_sum /* ２．売上実績金額 */
                    from (
                            select *
                            from sales_terms
                            where id = ".$sales_term_id."
                    ) as A
                    cross join (
                            select project_id,
                            sales_date,
                            sum(sales_amount) as sales_amount_sum
                            from sales_results
                            group by project_id
                    ) R
                    left outer join projects P
                    on P.id = R.project_id
                    where (R.sales_date between A.start_date and A.end_date) 
            ) T2
            on T2.id = T1.id

            left outer join (
                    select A.id,
                    sum(P.order_amount) as order_amount_sum /* ３．売上見込金額 */
                    from (
                            select *
                            from sales_terms
                            where id = ".$sales_term_id."
                    ) as A
                    cross join projects P /* 案件情報 */
                    where (P.sales_date between A.start_date and A.end_date) 
            ) T3
            on T3.id = T1.id;
        "));

        //Session::set_flash('success', 'クエリー内容: '.$query->__toString());        

        $sales_total = $query
                ->execute()
                ->as_array();

        return $sales_total;
    }

    /**
     * 集計結果取得（グループ別）
     * @param int $sales_term_id 対象期間ID
     */
    private function make_sum_for_group($sales_term_id = '0') {

        //グループ毎の集計
        $query = DB::select(DB::expr("
               T4.group_name as row_title, 
               T1.target_amount_sum, 
               ifnull(T2.sales_amount_sum,0) as sales_amount_sum, 
               ifnull(T3.order_amount_sum,0) as order_amount_sum, 
               T1.min_amount_sum
            from (
                    SELECT 
                            Z.id as id, 
                            Z.group_id as group_id, 
                            sum(ifnull(Z.target_amount,0)) as target_amount_sum, /*　１．売上目標金額　*/
                            sum(ifnull(Z.min_amount,0)) as min_amount_sum, /*　４．売上最低金額　*/
                            Z.start_date,
                            Z.end_date
                    from (
                            select
                                    A.id, 
                                    A.start_date,
                                    A.end_date,
                                    B.target_amount, 
                                    B.min_amount, 
                                    B.group_id
                            from sales_terms as A
                            left outer join sales_targets as B
                            on (B.sales_term_id = A.id)
                            where 
                            A.id = ".$sales_term_id."
                    ) AS Z
                    group by Z.group_id
            ) T1

            left outer join (
                    select P.group_id,
                    sum(ifnull(R.sales_amount_sum,0)) as sales_amount_sum /* ２．売上実績金額 */
                    from (
                            select *
                            from sales_terms
                            where id = ".$sales_term_id."
                    ) as A
                    cross join (
                            select project_id,
                            sales_date,
                            sum(ifnull(sales_amount,0)) as sales_amount_sum
                            from sales_results
                            group by project_id
                    ) R
                    left outer join projects P
                    on P.id = R.project_id
                    where (R.sales_date between A.start_date and A.end_date) 
                    group by P.group_id
            ) T2
            on T2.group_id = T1.group_id

            left outer join (
                    select P.group_id,
                    sum(ifnull(P.order_amount,0)) as order_amount_sum /* ３．売上見込金額 */
                    from (
                            select *
                            from sales_terms
                            where id = ".$sales_term_id."
                    ) as A
                    cross join projects P /* 案件情報 */
                    where (P.sales_date between A.start_date and A.end_date) 
                    group by P.group_id
            ) T3
            on T3.group_id = T1.group_id

            left outer join groups T4
            on T4.id = T1.group_id

            order by T1.group_id asc;
        "));

        //Session::set_flash('success', 'クエリー内容: '.$query->__toString());        

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
        $queryGroup = DB::select('id', 'group_name')
                ->from('groups');

        $groups = $queryGroup
                ->execute()
                ->as_array();

        //指定された対象期間で、グループ毎に集計する
        foreach ($groups as $group) {

            $query = DB::select(DB::expr("
                T4.emp_name as row_title, T1.target_amount_sum, T2.sales_amount_sum, T3.order_amount_sum, T1.min_amount_sum
                from (
                        SELECT 
                                Z.id as id, 
                                Z.group_id as group_id, 
                                sum(ifnull(Z.target_amount,0)) as target_amount_sum, /*　１．売上目標金額　*/
                                sum(ifnull(Z.min_amount,0)) as min_amount_sum, /*　４．売上最低金額　*/
                                Z.start_date,
                                Z.end_date
                        from (
                                select
                                        A.id, 
                                        A.start_date,
                                        A.end_date,
                                        B.target_amount, 
                                        B.min_amount, 
                                        B.group_id
                                from sales_terms as A
                                left outer join sales_targets as B
                                on (B.sales_term_id = A.id)
                                where A.id = ".$sales_term_id."
                                and B.group_id = ".$group['id']."
                        ) AS Z
                        group by Z.group_id
                ) T1

                left outer join (
                        select
                        W.group_id,
                        W.emp_id,
                        sum(ifnull(W.sales_amount_sum,0)) as sales_amount_sum /* ２．売上実績金額 */

                        from (
                                select *
                                from sales_terms
                                where id = ".$sales_term_id."
                        ) as A

                        cross join (
                                select *
                                from (	
                                        select 
                                        P.group_id,
                                        P.emp_id,
                                        sum(ifnull(R.sales_amount_sum,0)) as sales_amount_sum,
                                        R.sales_date
                                        from
                                        (
                                                select
                                                project_id,
                                                sales_date,
                                                sum(ifnull(sales_amount,0)) as sales_amount_sum
                                                from sales_results
                                                group by project_id
                                        ) R
                                        left outer join projects P
                                        on P.id = R.project_id

                                ) X
                        ) W

                        where (W.sales_date between A.start_date and A.end_date) 
                        and W.group_id = ".$group['id']."
                        group by W.group_id, W.emp_id

                ) T2
                on T2.group_id = T1.group_id

                left outer join (
                        select P.group_id,
                        P.emp_id,
                        sum(ifnull(P.order_amount,0)) as order_amount_sum /* ３．売上見込金額 */
                        from (
                                select *
                                from sales_terms
                                where id = ".$sales_term_id."
                        ) as A
                        cross join projects P /* 案件情報 */
                        where (P.sales_date between A.start_date and A.end_date) 
                        and P.group_id = ".$group['id']."
                        group by P.group_id, P.emp_id
                ) T3
                on T3.group_id = T1.group_id

                left outer join employees T4
                on T4.id = T3.emp_id

                order by T3.emp_id asc;
            "));

            //Session::set_flash('success', 'クエリー内容: '.$queryT1->__toString());        
            
            $tabledata = $query
                    ->execute()
                    ->as_array();

            //小計行追加
            $row_sum = array('row_title' => '小計', 'target_amount_sum' => 0, 'sales_amount_sum' => 0, 'order_amount_sum' => 0, 'min_amount_sum' => 0);
            foreach($tabledata as $each_row){
                $row_sum['target_amount_sum'] = $each_row['target_amount_sum']; // 売上目標金額は重複するため積み上げません
                $row_sum['sales_amount_sum'] += $each_row['sales_amount_sum'];
                $row_sum['order_amount_sum'] += $each_row['order_amount_sum'];
                $row_sum['min_amount_sum'] = $each_row['min_amount_sum']; // 売上最低金額は重複するため積み上げません
            }
            $tabledata[] = $row_sum;
            
            //グループ毎にデータを取得、設定
            $sales_total[$group['id']] = Array('title' => $group["group_name"].'　　目標金額：'.number_format($row_sum["target_amount_sum"]/1000).'　　最低金額：'.number_format($row_sum['min_amount_sum']/1000), 'list' => $tabledata);
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
        $mpdf = new mPDF('ja', 'A4-L');
        $mpdf->WriteHTML($html);
        $mpdf->Output('売上集計結果.pdf', 'I');
    }
    
}
