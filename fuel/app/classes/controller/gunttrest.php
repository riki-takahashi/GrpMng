<?php
class Controller_Gunttrest extends Controller_Rest
{
    public function get_guntt()
    {

        $query = DB::select(DB::expr("            

          A.emp_id
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
        //$toPrevious = null; //To前回処理値
        $value = array(); //1案件毎のデータ
        $empIdPrevious = ''; //社員IDの前回処理値
        
        foreach ($results as $result) {
            if ($empIdPrevious == ''){
                $empIdPrevious = $result['emp_id'];
            }
            if ($empIdPrevious != $result['emp_id']){
                $json[] = $person; //メンバー１人分を出力に追加
                $person = array(); // メンバー１人のデータを初期化
            }
            $empIdPrevious = $result['emp_id']; //社員IDの現在値を退避
            
            $person['name'] = $result['name'];
            $person['desc'] = '';
            
            $value["from"] = "/Date('".$result['from']."')/";
            $value["to"] = "/Date('".$result['to']."')/";
            //$toPrevious = Date::forge($result['to']);
            $value["label"] = $result['label'];
            $value["customClass"] = "ganttRed";
            $person["values"][] = $value; //1案件分を追加
            
            $value = array(); //1案件毎のデータを初期化
        }
        
        //最終行の処理
        $json[] = $person; //メンバー１人分を出力に追加

        $this->response($json);

    }
}