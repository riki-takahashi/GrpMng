<?php
class Controller_Gunttrest extends Controller_Rest
{
    public function get_guntt()
    {

        $query = DB::select(DB::expr("            
            G.group_name 'name'
          , E.emp_name 'desc'
          , A.start_date 'from'
          , A.end_date 'to'
          , P.project_name 'label'

          from group_employee D

          left outer join groups G
          on D.group_id = G.id

          left outer join employees E
          on D.emp_id = E.id

          left outer join projectmembers A
          on E.id = A.emp_id

          left outer join projects P
          on A.project_id = P.id

          order by D.group_id, D.emp_id
        "));

        $results = $query
            ->execute()
            ->as_array();
            
        foreach ($results as $result) {
            $persons['name'] = $result['name'];
            $persons['desc'] = $result['desc'];
            $persons["values"][0]["from"] = "/Date('".$result['from']."')/";
            $persons["values"][0]["to"] = "/Date('".$result['to']."')/";
            $persons["values"][0]["label"] = $result['label'];
            $persons["values"][0]["customClass"] = "ganttRed";
            $json[] = $persons;
        }

        $this->response($json);

    }
}