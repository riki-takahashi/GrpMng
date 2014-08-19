<?php
class Controller_Gunttrest extends Controller_Rest
{
    public function get_guntt()
    {

        $query = DB::select(DB::expr("

          A.emp_id
        , A.project_id
        , E.emp_name 'name'
        , A.start_date 'from'
        , A.end_date 'to'
        , P.project_name 'label'

        from projectmembers A

        left outer join employees E
        on A.emp_id = E.id

        left outer join projects P
        on A.project_id = P.id

        order by A.emp_id, A.start_date, A.project_id

        "));

        $results = $query
            ->execute()
            ->as_array();
            
        // 初期化
        $json = array(); //最終的に出力される全体のデータ
        $person = array(); //メンバー１人のデータ
        $fromCurrent = null; //From今回処理値
        $toPrevious = null; //To前回処理値
        $value = array(); //1案件毎のデータ
        $empIdPrevious = ''; //社員IDの前回処理値
        
        foreach ($results as $result) {
            //前回値がセットされていなければ初期化する
            if ($empIdPrevious == ''){
                $empIdPrevious = $result['emp_id']; //社員IDの前回処理値を初期化
                $toPrevious = Date::forge('1900-01-01'); //To前回処理値を初期化（日付型の最小値を代入）
                //先頭行には社員氏名が必要なため代入する
                $person['name'] = $result['name'];
            }
            
            //社員IDの今回処理値が前回値と異なれば、そこまでのデータを出力に追加する
            //また、今回処理のFromが前回処理のToより小さければデータを出力に追加する
            $fromCurrent = Date::forge($result['from']); //今回処理のFrom
            if (($empIdPrevious != $result['emp_id']) or ($fromCurrent < $toPrevious)){
                $json[] = $person; //メンバー１人分を出力に追加
                $person = array(); //出力後、不要になったメンバー１人のデータを初期化
            }
            
            if($empIdPrevious != $result['emp_id']){
                //社員IDが異なれば氏名を代入する
                $person['name'] = $result['name'];
            }
            
            $empIdPrevious = $result['emp_id']; //社員IDの現在値を次回のために退避(社員IDの前回処理値)
            $toPrevious = Date::forge($result['to']); //Toの現在値を次回のために退避(To前回処理値)
            
            $person['desc'] = '';
            $value['from'] = "/Date('".$result['from']."')/";
            $value['to'] = "/Date('".$result['to']."')/";
            $value['label'] = $result['label'];
            $value['customClass'] = 'ganttRed';
            $value['dataObj'] = $result['project_id'];
            $person['values'][] = $value; //1案件分を追加
            $value = array(); //1案件毎のデータを初期化
        }
        
        //最終行の処理
        $json[] = $person; //メンバー１人分を出力に追加
        
        //このコントローラはRESTのため『.JSON』でリクエストされたらJSON形式で出力データを返す
        $this->response($json);

    }
}